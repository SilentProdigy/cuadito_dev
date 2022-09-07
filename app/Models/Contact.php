<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'client_id',
        'contact_id'
    ];

    protected $appends = [
        'contact_name',
        'contact_email',
        'is_existing_client'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function contact()
    {
        return $this->belongsTo(\App\Models\Client::class, 'contact_id');
    }

    public function getContactNameAttribute()
    {
        return $this->contact_id ? $this->contact->name : $this->name;
    }

    public function getContactEmailAttribute()
    {
        return $this->contact_id ? $this->contact->email : $this->email;
    }

    public function getIsExistingClientAttribute()
    {
        return isset( $this->contact_id );
    }

}
