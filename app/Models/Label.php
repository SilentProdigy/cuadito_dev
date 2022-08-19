<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }
}
