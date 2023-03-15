<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequirement extends Model
{
    use HasFactory;

    protected $table = "project_requirements";

    protected $fillable = [
        'project_id',
        'requirement_id'
    ];

    protected $appends = [
        'requirement_name'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function requirement()
    {
        return $this->belongsTo(ClientProjectRequirement::class, 'requirement_id');
    }

    public function getRequirementNameAttribute()
    {
        return $this->requirement?->name;
    }
}
