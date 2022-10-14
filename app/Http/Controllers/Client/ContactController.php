<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Contacts\CreateContactRequest;
use App\Mail\Contact\SignupInvitation;
use App\Models\Client;
use App\Models\Contact;
use App\Services\ContactService;
use App\Traits\SendSignupInvitationEmail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    use SendSignupInvitationEmail;

    private $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
        $this->middleware([
            'client.validate.ensure_email_dont_exist_on_contacts', 
            'client.validate.ensure_email_dont_exist_on_system'
        ])
        ->only('store');
    }

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
            $contact = auth('client')->user()->contacts()->create($data);
            $this->sendSignupInvitationEmail($contact);
            return redirect(route('client.contacts.index'))->with('success', 'Contact was added successfully!');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try
        {              
            $contact = Contact::query();
            
            $contact = $request->input('type') == 'contact' ? 
                        $contact->findOrFail($request->input('contact_id')) : 
                        auth('client')->user()->contacts
                        ->where('contact_id', $request->input('contact_id'))
                        ->firstOrFail();

            $contact->delete();

            return redirect(route('client.contacts.index'))->with('success', 'Contact was deleted successfully!');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
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
