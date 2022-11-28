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
        'max_proposals_count',
        'max_projects_count'
    ];

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\Subscription::class);
    }
}
