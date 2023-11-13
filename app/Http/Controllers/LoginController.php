<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        // Validate the user input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt user authentication
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication succeeded, redirect to the appropriate dashboard based on the user's role.
            $user = Auth::user();

            if ($user->isHeadmaster()) {
                return redirect('/headmaster');
            } elseif ($user->isRegistrar()) {
                return redirect('/registrar');
            } 
        }

        // Authentication failed, redirect back with an error message.
        return redirect('/login')->with('error', 'Invalid login credentials.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

}
