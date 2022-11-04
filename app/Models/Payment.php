<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $fillable = [
        'subscription_id',
        'amount',
        'additional_vat',
        'total_amount',
        'mode_of_payment',
        'details'
    ];

    public function subscription()
    {
        return $this->belongsTo(\App\Models\Subscription::class);
    }
}
