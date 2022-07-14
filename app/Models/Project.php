<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public const ACTIVE_STATUS = "ACTIVE";
    public const ON_HOLD_STATUS = "ON HOLD";
    public const CLOSED_STATUS = "CLOSED";

    const MAX_DESCRIPTION_LENGTH = 200;

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

    protected $cast = [
        'max_date' => 'date'
    ];

    protected $with = ['company'];

    protected $withCount = ['proposals'];

    protected $appends = [
        'max_active_date'
    ];

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function biddings()
    {
        return $this->hasMany(\App\Models\Bidding::class);
    }

    public function proposals()
    {
        return $this->hasMany(\App\Models\Bidding::class);
    }

    public function getMaxActiveDateAttribute()
    {
        return Carbon::parse($this->max_date)->format('M d,Y');
    }

    public function getDescriptionTextAttribute()
    {
        if(strlen($this->description) > self::MAX_DESCRIPTION_LENGTH)
        {
            return $this->description . "<br>" . "<a href='" . route('client.listing.show', $this->id) . "'>See More</a>";
        }

        return $this->description;
    }
}
