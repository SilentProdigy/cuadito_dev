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
        'contact_profile_picture',
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

    public function getContactProfilePictureAttribute()
    {
        // return $this->contact_id ? $this->contact-> : $this->email;
        if($this->contact_id) {
            return $this->contact->profile_picture_url;
        }

        return "https://mdbootstrap.com/img/new/avatars/8.jpg";
    }

    public function getIsExistingClientAttribute()
    {
        return isset( $this->contact_id );
    }

    static function connectTwoClients(Client $client_01, Client $client_02)
    {   
        if(!$client_01->isConnected($client_02))
        {
            $client_01->contacts()->create([
                'contact_id' => $client_02->id
            ]);
        }

        if(!$client_02->isConnected($client_01))
        {
            $client_02->contacts()->create([
                'contact_id' => $client_01->id
            ]);
        }   
    }
}
