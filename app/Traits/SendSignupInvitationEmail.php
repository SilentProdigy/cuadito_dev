<?php 

namespace App\Traits;

use App\Mail\Contact\SignupInvitation;
use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\Mail;

trait SendSignupInvitationEmail
{
    // use SendEmail

    public function sendSignupInvitationEmail(Contact $contact)
    {
        Mail::to($contact->email)->send(new SignupInvitation($contact));
    }
}