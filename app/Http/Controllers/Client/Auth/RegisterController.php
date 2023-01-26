<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\RegisterFormRequest;
use App\Models\Client;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
         // Check if user is loggedin
         if(auth('client')->user())
         {
             return redirect(route('client.dashboard'));
         }

        $register_route = route('client.auth.register');

        if(request()->has('code'))
        {
            $contact = Contact::where('id', request()->input('code'))->firstOrFail();

            $register_route = route('client.auth.register', ['code' => $contact->id]);
        }

        return view('client.auth.register')->with(compact('register_route'));
    }

    public function register(RegisterFormRequest $request)
    {    
        DB::beginTransaction();
    
        try
        {
            $data = $request->only(['name', 'email']);
            $data['password'] = bcrypt($request->input('password'));
            
            # Create a new client
            $client = Client::create($data);
    
            // Process clients that are registered using an invitation link
            if($request->has('code'))
            {
                $contact = Contact::where('id', $request->input('code'))->firstOrFail();

                // Update the connection between the invitor and invited client
                $contact->update([
                    'contact_id' => $client->id,
                    'email' => "",
                    'name' => ""
                ]);

                // add the invitor as default contact or connection
                $client->contacts()->create([
                    'contact_id' => $contact->client_id
                ]);
            }
    
            # Generate session + guard 
            if(Auth::guard('client')->attempt($request->only(['email', 'password'])))
            {
                DB::commit();
                $request->session()->regenerate();
                return redirect(route('client.dashboard'));
            }
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
        
    }
}
