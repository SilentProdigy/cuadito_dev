<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'email',
        // 'password',
        'contact_number',
        'validation_status',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function biddings()
    {
        return $this->hasMany(\App\Models\Bidding::class);
    }

    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class);
    }
}
