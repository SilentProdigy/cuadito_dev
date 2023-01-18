<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'required'
    ];

    public const REQUIREMENT_IDS = [1,2,3,4];

    public const APPROVED_STATUS = 'APPROVED';
    public const DISAPPROVED_STATUS = 'DISAPPROVED';


    public function companies()
    {
        return $this->belongsToMany(\App\Models\Company::class, 'company_requirement')
                ->as('file')
                ->withPivot(['url']);
    }
}
