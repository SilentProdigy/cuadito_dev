<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Contacts\CreateContactRequest;
use App\Mail\Contact\SignupInvitation;
use App\Models\Client;
use App\Models\Contact;
use App\Traits\SendSignupInvitationEmail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    use SendSignupInvitationEmail;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = null;

        if(request()->has('search'))
        {
            $clients = Client::where('id', '!=',auth('client')->user()->id)
            ->where(function($q) {
                $q->where('name', 'LIKE', '%' . request()->input('search') . '%')
                ->orWhere('email', 'LIKE', '%' . request()->input('search') . '%');
            })
            ->get();

            // return $clients;
        }

        $contacts = auth('client')->user()->contacts;
        return view('client.contacts.index')->with(compact('contacts', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContactRequest $request)
    {
        try 
        {
            // Will store non existing client. 

            $data = $request->all();

            if( auth('client')->user()->contacts()->where('email', $request->input('email'))->exists() )
            {
                return redirect()->back()->withErrors('Email already exist in your contact list!');
            }

            $client = Client::where('email', $request->input('email'))->first(); 

            if($client)
            {
                return redirect(route('client.contacts.index'))->withErrors('Cannot add contact, please try to search and connect instead.');
            }

            $contact = auth('client')->user()->contacts()->create($data);
            
            $this->sendSignupInvitationEmail($contact);

            return redirect(route('client.contacts.index'))->with('success', 'Contact was added successfully!');
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        
    }

    public function invite(Contact $contact)
    {   
        try 
        {
            $this->sendSignupInvitationEmail($contact);
            return redirect(route('client.contacts.index'))->with('success', 'Invitation was successfully sent!');
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
