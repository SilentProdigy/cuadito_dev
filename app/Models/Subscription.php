<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public $fillable = [
        'subscription_type_id',
        'client_id',
        'expiration_date',
        'status',
        'points'
    ];

    public const ACTIVE_STATUS = "ACTIVE";
    public const INACTIVE_STATUS = "INACTIVE";

    public function subscription_type()
    {
        return $this->belongsTo(\App\Models\SubscriptionType::class);
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }
}

