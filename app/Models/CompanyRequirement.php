<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'url',
        'status',
        'remarks'
    ];

    protected $table = 'company_requirement';

    public const FOR_APPROVAL_STATUS = "FOR APPROVAL";
    public const APPROVED_STATUS = "APPROVED";
    public const DISAPPROVED_STATUS = "DISAPPROVED";

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
