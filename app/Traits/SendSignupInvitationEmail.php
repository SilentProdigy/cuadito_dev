<?php 

namespace App\Traits;

use App\Mail\Contact\SignupInvitation;
use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\Mail;

trait SendSignupInvitationEmail
{
    public function sendSignupInvitationEmail(Contact $contact)
    {
        try 
        {
            Mail::to($contact->email)->send(new SignupInvitation($contact));
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}