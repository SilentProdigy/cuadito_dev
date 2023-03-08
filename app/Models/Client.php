<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'address',
        'marital_status',
        'email',
        'password',
        'contact_number',
        'profile_pic',
        'tag_line'
    ];

    protected $cast = [
        'birth_date' => 'date'
    ];

    protected $hidden = [
        'password'
    ];

    protected $appends = [
        'have_companies',
        'have_valid_companies',
        'projects_count',
        'companies_count',
        'have_unread_notifications',
        'profile_picture_url',
        // 'active_subscription',
        // 'have_subscription',

    ];

    public const ITEMS_PER_PAGE = 5;

    public const CIVIL_STATUS_OPTIONS = [ 
        "Single",
        "Married",
        "Widowed",
        "Divorced"
    ];

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }

    public function company()
    {
        return $this->hasOne(\App\Models\Company::class);
    }

    public function companies() 
    {
        return $this->hasMany(\App\Models\Company::class);
    }

    public function projects()
    {
        return $this->hasManyThrough(\App\Models\Project::class, \App\Models\Company::class);
    }
    
    public function payments()
    {
        return $this->hasManyThrough(\App\Models\Payment::class, \App\Models\Subscription::class);
    }

    public function biddings()
    {
        return $this->hasManyThrough(\App\Models\Bidding::class, \App\Models\Company::class);
    }

    public function getHaveCompaniesAttribute()
    {
        return $this->companies->count() > 0;
    }

    public function getHaveValidCompaniesAttribute()
    {
        return $this->companies()->where('validation_status', \App\Models\Company::APPROVED_STATUS)->count() > 0;
    }

    public function requirements()
    {
        return $this->belongsToMany(\App\Models\Requirement::class, 'client_requirements')
                ->as('file')
                ->withPivot(['id','url']);
    }

    public function contacts()
    {
        return $this->hasMany(\App\Models\Contact::class, 'client_id');
    }

    public function getProjectsCountAttribute()
    {
        return $this->projects()->count();
    }

    public function getCompaniesCountAttribute()
    {
        return $this->companies()->count();
    }

    public function getApprovedCompaniesAttribute()
    {
        return $this->companies()->approved()->get();
    }

    public function getHaveUnreadNotificationsAttribute()
    {
        return $this->notifications()
                ->where('opened', false)
                ->whereNull('type')
                ->exists();
    }

    public function getUnreadNotificationsCountAttribute()
    {
        return $this->notifications()
                ->where('opened', false)
                ->whereNull('type')
                ->count();
    }

    public function conversationSubscriptions()
    {
       return $this->hasMany(\App\Models\ConversationSubscription::class);
    }

    public function labels()
    {
        return $this->hasMany(\App\Models\Label::class);
    }

    public function getUnreadConversationsCountAttribute()
    {
        return $this->conversationSubscriptions->filter(function($item) {
            return $item->conversation->have_unread_messages;
        })
        ->count();
    }

    public function getUnreadImportantConversationsCountAttribute()
    {
        return $this->conversationSubscriptions->filter(function($item) {
            return $item->conversation->have_unread_messages && $item->is_important;
        })
        ->count();
    }

    public function getIsConnectedAttribute()
    {
        return auth('client')->user()->contacts()->where('contact_id', $this->id)->exists();
    }

    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_pic ? asset("storage/".$this->profile_pic) : asset('images/avatar/12.png');
    }

    // public function subscriptions()
    // {
    //     return $this->hasMany(\App\Models\Subscription::class);
    // }

    // public function getHaveSubscriptionAttribute()
    // {
    //     return $this->subscriptions()
    //                 ->where('status', \App\Models\Subscription::ACTIVE_STATUS)
    //                 ->exists();
    // }

    // public function getActiveSubscriptionAttribute()
    // {
    //     return $this->subscriptions()->where('status', \App\Models\Subscription::ACTIVE_STATUS)->first();
    // }

    // public function getLatestSubscriptionAttribute()
    // {
    //     return $this->subscriptions()->orderBy('id', 'desc')->first();
    // }

    public function getHaveUnopenedMessagesCountAttribute()
    {
        return $this->notifications()->close()->messageType()->count(); 
    }

    public function getHaveUnopenedMessagesAttribute()
    {
        return $this->notifications()->close()->messageType()->count() > 0; 
    }

    public function isConnected(Client $client)
    {
        return $this->contacts()->where(['contact_id' => $client->id])->exists();
    }
}
