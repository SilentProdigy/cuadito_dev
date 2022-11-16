<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Mail;

trait SendEmail 
{ 
    private function sendEmail($receiving_emails, $mailable)
    {
        $result = Mail::to($receiving_emails)->queue($mailable);
    }
}