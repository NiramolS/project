<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function loginForm() {
        return view('login.login-form');
    }

    function authenticate(Request $request) {
        // get creadentials from user
        $data = $request->getParsedBody();
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        // authenticate by using method attempt()
        if (Auth::attempt($credentials)){
            // regenerate the new session ID
            session()->regenerate();
            // redirect to the requested URL or to route product-list f does not specify
            return redirect()->intended(route('product-list'));
        }
        // if cannot authenticate redirect back to loginForm with error message
        return redirect()->back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.'
        ]);
    }
    function logout(){
        Auth::logout();
        session()->invalidate();
        //regenerate CSRF token
        session()->regenerateToken();

        return redirect()->route('login');
    }
}
