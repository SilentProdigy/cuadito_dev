<?php
namespace App\Services;

use Illuminate\Validation\ValidationException;

class ContactService 
{
    public function checkIfEmailIsInContactList($email)
    {
        $exist =  auth('client')->user()
                ->contacts()
                ->where('email', $email)->exists();

        if($exist) {
            throw ValidationException::withMessages([
                'message' => 'Email already exist in your contact list!'
            ]);
        }
    }


}