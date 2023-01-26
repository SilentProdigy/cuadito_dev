<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
 
    public function showLoginForm() 
    {
        // Check if user is loggedin
        if(auth('client')->user())
        {
            return redirect(route('client.dashboard'));
        }

        return view('client.auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        if( Auth::guard('client')->attempt($request->only(['email', 'password'])) )
        {
            $request->session()->regenerate();
            return redirect(route('client.dashboard'));
        }

        return redirect()->back()->withErrors([
            'email' => 'Email is incorrect!',
            'password' => 'Password is incorrect!'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(route('client.auth.show-login-form'));
    }
}
