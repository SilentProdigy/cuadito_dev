<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'address',
        'marital_status',
        'email',
        'password',
        'contact_number'
    ];

    protected $cast = [
        'birth_date' => 'date'
    ];

    public function companies() 
    {
        return $this->hasMany(\App\Models\Company::class);
    }

}
