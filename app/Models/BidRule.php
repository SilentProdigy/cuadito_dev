<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_project_cost',
        'max_project_cost',
        'percentage'
    ];

    public static function bidRules($projectCost)
    {
        return self::where(function ($query) use ($projectCost) {
            $query->where('min_project_cost', '<=', $projectCost)
                  ->where(function ($query) use ($projectCost) {
                      $query->where('max_project_cost', '>', $projectCost)
                            ->orWhereNull('max_project_cost');
                  });
        })->first();
    }
}
