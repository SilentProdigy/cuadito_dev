<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'url'
    ];

    public const ALLOWED_FILE_TYPES = [
        'png',
        'jpg',
        'jpeg',
        'pdf'
    ];

    protected $appends = ['file_name'];

    public const MAX_FILE_SIZE = 1015506;

    /**
     * Get the parent attachmentable model (bidding).
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }

    public function getFileNameAttribute()
    {
        $url = $this->url; 
        $result = explode("/", $url);
        return $result[count($result) - 1];
    }
}
