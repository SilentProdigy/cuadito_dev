<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProjectRequirement extends Model
{
    use HasFactory;

    protected $table = "client_project_requirements";

    protected $fillable = [
        'name',
        'description',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
