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
        'submitted_proposals_count',
        'submitted_projects_count',
    ];

    public const ACTIVE_STATUS = "ACTIVE";
    public const INACTIVE_STATUS = "INACTIVE";

    protected $casts = [
        'expiration_date' => 'datetime',
    ];

    public function subscription_type()
    {
        return $this->belongsTo(\App\Models\SubscriptionType::class);
    }

    public function scopeActive($query)
    {
        $query->where('status', self::ACTIVE_STATUS);
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    public function getRemainingProposalsAttribute()
    {
        if($this->status == self::INACTIVE_STATUS)
            return 0;

        return $this->subscription_type->max_proposals_count - $this->submitted_proposals_count;
    }

    public function getRemainingProjectsAttribute()
    {
        if($this->status == self::INACTIVE_STATUS)
            return 0;

        return $this->subscription_type->max_projects_count - $this->submitted_projects_count;
    }
}

