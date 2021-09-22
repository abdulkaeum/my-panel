<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! auth()->attempt($attributes)){
            throw ValidationException::withMessages([
                'authFail' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Hi '. auth()->user()->name);
    }

    public function destroy()
    {
        $name = auth()->user()->name;

        auth()->logout();

        return redirect('login')->with('info', 'Goodbye '. $name);
    }
}
