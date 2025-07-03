<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    /**
     * Display the login view if the user is not authenticated.
/*******  9ed7ef8a-c45d-4cbd-88d0-ff0c11c7dbca  *******/
    //
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function store(Request $request)
    {
        // Validate required inputs
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            // 'g-recaptcha-response' => 'required|recaptcha', // Uncomment if reCAPTCHA is enabled
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Try logging in using 'username'
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect()->intended('/dashboard');
        }

        // Try logging in using 'email'
        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            return redirect()->intended('/dashboard');
        }

        // Authentication failed
        return redirect('/')
            ->withErrors([
                'username' => trans('messages.username_not_match'),
                'password' => trans('messages.password_not_match'),
            ])
            ->withInput($request->only('username'));
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/');   
    }
    
}
