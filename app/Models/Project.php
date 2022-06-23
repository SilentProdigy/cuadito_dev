<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function biddings()
    {
        return $this->hasMany(\App\Models\Bidding::class);
    }
}
