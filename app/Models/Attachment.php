<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    /**
     * Get the parent attachmentable model (bidding).
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }
}
