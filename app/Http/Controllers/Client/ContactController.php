<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Contacts\CreateContactRequest;
use App\Mail\Contact\SignupInvitation;
use App\Models\Client;
use App\Models\Contact;
use App\Services\ContactService;
use App\Traits\SendEmail;
use App\Traits\SendSignupInvitationEmail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use ProtoneMedia\LaravelXssProtection\Middleware\XssCleanInput;

class ContactController extends Controller
{
    // use SendSignupInvitationEmail;
    use SendEmail;

    private $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
        $this->middleware([
            'client.validate.ensure_email_dont_exist_on_contacts', 
            'client.validate.ensure_email_dont_exist_on_system',
            XssCleanInput::class
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
        DB::beginTransaction();

        try 
        {
            // Will store non existing client. 
            $data = $request->all();
            $contact = auth('client')->user()->contacts()->create($data);
            // $this->sendSignupInvitationEmail($contact);
            $this->sendEmail([$contact->email], new SignupInvitation($contact));
            DB::commit();


            return redirect(route('client.contacts.index'))->with('success', 'Contact was added successfully!');
        }
        catch(\Exception $e)
        {
            DB::rollBack();

            Log::error('CONTACT_CREATE_FAILED: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
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
        DB::beginTransaction();

        try
        {              
            $contact = Contact::query();
            
            $contact = $request->input('type') == 'contact' ? 
                        $contact->findOrFail($request->input('contact_id')) : 
                        auth('client')->user()->contacts
                        ->where('contact_id', $request->input('contact_id'))
                        ->firstOrFail();

            $contact->delete();

            DB::commit();

            return redirect(route('client.contacts.index'))->with('success', 'Contact was deleted successfully!');
        }
        catch(\Exception $e)
        {
            DB::rollBack();

            Log::error('DELETE_CONTACT_FAILED: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }

    public function invite(Contact $contact)
    {   
        try 
        {
            // $this->sendSignupInvitationEmail($contact);
            $this->sendEmail([$contact->email], new SignupInvitation($contact));
            return redirect(route('client.contacts.index'))->with('success', 'Invitation was successfully sent!');
        }
        catch(\Exception $e)
        {
            Log::error('SEND_INVITATION_FAILED: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }
}
