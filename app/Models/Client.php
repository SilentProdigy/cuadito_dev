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
        'contact_number'
    ];

    protected $cast = [
        'birth_date' => 'date'
    ];

    protected $appends = [
        'have_companies',
        'have_valid_companies',
        'projects_count',
        'companies_count',
        'have_unread_notifications'
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
        return $this->notifications()->where('opened', 0)->exists();
    }

    public function getUnreadNotificationsCountAttribute()
    {
        return $this->notifications()->where('opened', 0)->count();
    }

    public function conversationSubscriptions()
    {
       return $this->hasMany(\App\Models\ConversationSubscription::class);
    }

    public function labels()
    {
        return $this->hasMany(\App\Models\Label::class);
    }
}
