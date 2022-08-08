<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function sender()
    {
        return $this->belongsTo(\App\Models\Company::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(\App\Models\Company::class, 'receiver_id');
    }
}
