<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidding extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['company'];

    protected $fillable = [
        'company_id',
        'project_id',
        // 'quotation_url',
        'cover_letter',
        'rate',
    ];

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function attachments()
    {
        return $this->morphMany(\App\Models\Attachment::class, 'attachmentable');
    }
}
