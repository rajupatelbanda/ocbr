<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
{
    // Validate the incoming request data
    $attributes = request()->validate([
        'username' => 'required|max:255|min:2',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|min:5|max:255',
        'terms' => 'required'
    ]);

    // Create a new user with the validated attributes
    $user = User::create($attributes);

    // Automatically log in the new user
        auth()->login($user);

    // Redirect based on user type
    if (auth()->user()->user_type == 1) {
        return redirect('/dashboard');
    } else {
        return redirect('/cart');
    }
}
}

