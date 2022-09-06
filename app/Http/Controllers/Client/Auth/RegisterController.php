<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\RegisterFormRequest;
use App\Models\Client;
use App\Models\Contact;
use Exception;
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
        try
        {
            $data = $request->only(['name', 'email']);
            $data['password'] = bcrypt($request->input('password'));
            
            # Create a new client
            $client = Client::create($data);
    
            if($request->has('code'))
            {
                $contact = Contact::where('id', $request->input('code'))->firstOrFail();
    
                $contact->update([
                    'contact_id' => $client->id,
                    'email' => "",
                    'name' => ""
                ]);
            }
    
            # Generate session + guard 
            if( Auth::guard('client')->attempt($request->only(['email', 'password'])) )
            {
                $request->session()->regenerate();
                return redirect(route('client.dashboard'));
            }
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
        # Redirect client to dashboard
        
    }
}
