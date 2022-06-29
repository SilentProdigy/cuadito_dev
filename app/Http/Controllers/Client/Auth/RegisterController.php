<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\RegisterFormRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('client.auth.register');
    }

    public function register(RegisterFormRequest $request)
    {
        $data = $request->only(['name', 'email']);
        $data['password'] = bcrypt($request->input('password'));
        
        # Create a new client
        $client = Client::create($data);
        
        # Generate session + guard 
        if( Auth::guard('client')->attempt($request->only(['email', 'password'])) )
        {
            $request->session()->regenerate();
            return redirect(route('client.dashboard'));
        }

        # Redirect client to dashboard
        
    }
}
