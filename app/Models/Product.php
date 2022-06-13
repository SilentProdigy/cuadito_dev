<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory;
    use SearchableTrait;

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'columns' => [
            'name'  => 10,
        ]
    ];
}
