<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public const ACTIVE_STATUS = "ACTIVE";
    public const ON_HOLD_STATUS = "ON HOLD";
    public const CLOSED_STATUS = "CLOSED";

    public const PROJECT_STATES = [
        self::ACTIVE_STATUS,
        self::ON_HOLD_STATUS,
        self::CLOSED_STATUS,
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'max_date',
        'cost_and_payment',
        'scope_of_work',
        'terms_and_conditions',
        'relevant_authorities',
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
