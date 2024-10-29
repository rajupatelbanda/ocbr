<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();


            if (auth()->user()->user_type == 1) {
                return redirect()->intended('dashboard');
            } else {
                return redirect('/cart');
            }


        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
{
    // Store the user type before logging out
    $userType = auth()->user() ? auth()->user()->user_type : null;

    // Log out the user
    Auth::logout();

    // Invalidate the session and regenerate the token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect based on user type if it exists
    if ($userType === 1) {
        return redirect('/login');
    } else {
        return redirect('/user-login');
    }
}

}
