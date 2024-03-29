<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public const ACTIVE_STATUS = "ACTIVE";
    public const ON_HOLD_STATUS = "ON HOLD";
    public const CLOSED_STATUS = "CLOSED";

    const MAX_DESCRIPTION_LENGTH = 200;

    public const ITEMS_PER_PAGE = 5;

    public const PROJECT_STATES = [
        self::ACTIVE_STATUS,
        self::ON_HOLD_STATUS,
        self::CLOSED_STATUS,
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'cost',
        'scope_of_work',
        'terms_and_conditions',
        'relevant_authorities',
        'remarks',
        'winner_bidding_id',
        'is_paid',
        'company_id',
        'created_at',
        'due_date',
    ];

    protected $cast = [
        'due_date' => 'date'
    ];

    protected $with = ['company'];

    protected $withCount = ['proposals'];

    protected $appends = [
        // 'max_active_date'
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
        return $this->hasMany(\App\Models\Bidding::class)->where('is_paid', true);
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, 'paymentable');
    }

    // public function getMaxActiveDateAttribute()
    // {
    //     return Carbon::parse($this->due_date)->format('M d,Y');
    // }

    public function getDescriptionTextAttribute()
    {
        if(strlen($this->description) > self::MAX_DESCRIPTION_LENGTH)
        {
            return substr($this->description, 0, self::MAX_DESCRIPTION_LENGTH) . "<br>" . "<a href='" . route('client.listing.show', $this->id) . "'>See More</a>";
        }

        return $this->description;
    }
    
    public function winningBidding()
    {
        return $this->belongsTo(\App\Models\Bidding::class, 'winner_bidding_id');
    }

    public function getWinningClientAttribute()
    {
        return $this->winningBidding?->company?->client;
    }

    public function getIsWinnerAttribute()
    {
        $winningBidding = $this->winningBidding;

        if(!$winningBidding) return false;

        return $winningBidding?->id == auth('client')->user()->id;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::ACTIVE_STATUS => "<span class='badge rounded-pill bg-success px-3 py-2'>ACTIVE</span>",
            self::ON_HOLD_STATUS => "<span class='badge rounded-pill bg-danger px-3 py-2'>ON HOLD</span>",
            self::CLOSED_STATUS => "<span class='badge rounded-pill bg-warning px-3 py-2'>CLOSED</span>",
        ];
    
        return $badges[$this->status];
    }

    public function getOwnerAttribute()
    {
        return $this->company->client;
    }

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE_STATUS);
    }

    public function getIsOwnedAttribute()
    {
        return auth('client')->user()->id == $this->company->client_id;
    }

    public static function getProjectsOverviewPerMonth($year = '2023')
    {
        
    }

    public function markAsPaid()
    {
        self::update(['is_paid' => true]);
    }

    public function computeTotalAmount()
    {
        $total_amount = 0;
        $cost = $this->cost;

        if($cost < 50000) 
            $total_amount = 5000;
        else {
            $bidRule = BidRule::bidRules($cost);

            if(!$bidRule) abort(404);

            $total_amount = $cost * $bidRule->percentage;
        }

        return $total_amount;
    }

    public function requirements()
    {
        return $this->hasMany(ProjectRequirement::class);
    }
}
