<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    public const FOR_APPROVAL_STATUS = "FOR APPROVAL";
    public const APPROVED_STATUS = "APPROVED";
    public const DISAPPROVED_STATUS = "DISAPPROVED";

    protected $fillable = [
        'name',
        'address',
        'email',
        // 'password',
        'contact_number',
        'validation_status',
        'client_id',
        'remarks'
    ];

    public const COMPANY_STATES = [
        self::FOR_APPROVAL_STATUS,
        self::APPROVED_STATUS,
        self::DISAPPROVED_STATUS,
    ];

    protected $appends = [
        'can_upload_requirements',
        'have_complete_requirements'
    ];

    protected $withCount = [
        'projects'
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

    public function requirements()
    {
        return $this->belongsToMany(\App\Models\Requirement::class, 'company_requirement')
                ->as('file')
                ->withPivot(['id','url', 'status', 'remarks']);
    }

    public function getCanUploadRequirementsAttribute()
    {
        return $this->validation_status != self::APPROVED_STATUS; 
    }

    public function gethaveCompleteRequirementsAttribute()
    {
        $requirements = $this->requirements;

        return count(
            array_diff( $requirements->pluck('id')->toArray(), Requirement::REQUIREMENT_IDS)
        ) == 0;
    }

    public function scopeApproved($query)
    {
        return $query->where('validation_status', self::APPROVED_STATUS);
    }

    public function hasDisapprovedRequirements()
    {
        return $this->requirements->where('file.status', Requirement::DISAPPROVED_STATUS)->count() > 0;
    }

}
