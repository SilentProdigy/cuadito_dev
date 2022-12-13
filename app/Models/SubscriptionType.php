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

    // protected $withCount = [
    //     'active_subscriptions'
    // ];

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\Subscription::class);
    }

    public function active_subscriptions()
    {
        return $this->subscriptions()->where('status', Subscription::ACTIVE_STATUS);
    }
}
