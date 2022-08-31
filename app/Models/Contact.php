<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $appends = [
        'contact_name'
    ];

    protected $fillable = [
        'name',
        'email',
        'client_id',
        'contact_id'
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
        return $this->contact->name;
    }
}
