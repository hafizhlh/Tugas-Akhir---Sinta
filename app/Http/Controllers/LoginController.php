<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
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
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
            // Hide 'g-recaptcha-response' => 'recaptcha',
        ]);
// dd($validated);
        $credentials                  = $request->all('username', 'password');
        $emailCredentials['email']    = $request['username'];
        $emailCredentials['password'] = $request['password'];
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } elseif (Auth::attempt($emailCredentials)) {            
            return redirect('/dashboard');
        }else{
            $response=[
                'username' => [trans("messages.username_not_match")],
                'password' => [trans("messages.password_not_match")],
            ];
            return redirect('/')->withErrors($response);
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/');   
    }
    
}
