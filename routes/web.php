<?php

use App\Http\Controllers\DashBoard;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TodoTaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('login', [SessionController::class, 'create'])->name('login.create');
    Route::post('login', [SessionController::class, 'store'])->name('login.store');
    Route::get('register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashBoard::class, 'index'])->name('dashboard');
    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');

    Route::name('todolist.')->group(function () {
        Route::get('todolist', [TodoListController::class, 'index'])->name('index');
        //Route::get('todolist/{todolist}', [TodoListController::class, 'show'])->name('show');
        Route::post('todolist', [TodoListController::class, 'store'])->name('store');
        Route::get('todolist/{todolist}/edit', [TodoListController::class, 'edit'])->name('edit');
        Route::patch('todolist/{todolist}', [TodoListController::class, 'update'])->name('update');
        Route::delete('todolist/{todolist}', [TodoListController::class, 'destroy'])->name('destroy');

        Route::patch('todolist/{todolist}/flag', [TodoListController::class, 'flag'])->name('flag');
    });

    Route::post('todotask/{todolist}', [TodoTaskController::class, 'store'])->name('todotask.store');
    Route::patch('todotask/{todolist}', [TodoTaskController::class, 'update'])->name('todotask.update');
});
