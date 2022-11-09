<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'amount',
        'points'
    ];

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\Subscription::class);
    }
}
