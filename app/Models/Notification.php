<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'content',
        'url',
        'opened',
        'notifiable_id',
        'notifiable_type'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
}
