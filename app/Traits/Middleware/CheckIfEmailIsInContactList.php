<?php 

namespace App\Traits\Middleware;

trait CheckIfEmailIsInContactList
{
    public function checkIfEmailIsInContactList($email)
    {
        return auth('client')->user()->contacts()->where('email', $email)->exists();
    }
}