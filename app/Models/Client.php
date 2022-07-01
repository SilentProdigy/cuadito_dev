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
        'have_valid_companies'
    ];

    public function companies() 
    {
        return $this->hasMany(\App\Models\Company::class);
    }

    public function projects()
    {
        return $this->hasManyThrough(\App\Models\Project::class, \App\Models\Company::class);
    }

    public function getHaveCompaniesAttribute()
    {
        return $this->companies->count() > 0;
    }

    public function getHaveValidCompaniesAttribute()
    {
        return $this->companies->where('status', \App\Models\Company::APPROVED_STATUS)->count() > 0;
    }
}
