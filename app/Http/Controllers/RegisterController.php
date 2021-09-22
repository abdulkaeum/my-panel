<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\logicalNot;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name'      => ['required', 'min:5'],
            'username'  => ['required', 'min:5', 'max:10', Rule::unique('users', 'username')],
            'email'     => ['required', 'email', 'min:7', Rule::unique('users' ,'email')],
            'password'  => ['required', 'min:7'],
        ]);

        $user = User::create($attributes);

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'You\'re registered');
    }
}
