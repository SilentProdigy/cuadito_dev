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

    public function clients()
    {
        return $this->belongsToMany(\App\Models\Client::class, 'client_requirements')
                ->as('file')
                ->withPivot(['url']);
    }
}
