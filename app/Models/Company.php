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
        'client_id'
    ];

    public const COMPANY_STATES = [
        self::FOR_APPROVAL_STATUS,
        self::APPROVED_STATUS,
        self::DISAPPROVED_STATUS,
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
                ->withPivot(['id','url']);
    }
}
