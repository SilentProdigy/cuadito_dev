<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiddingRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'bidding_id',
        'project_requirement_id',
        'url'
    ];

    protected $appends = [
        'requirement_name'
    ];

    public function bidding()
    {
        return $this->belongsTo(Bidding::class);
    }

    public function projectRequirement()
    {
        return $this->belongsTo(ProjectRequirement::class);
    }

    public function getRequirementNameAttribute()
    {
        return $this->projectRequirement?->requirement?->name;
    }
}
