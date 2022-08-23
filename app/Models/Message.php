<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    const TRUNCATE_LENGTH = 500;

    protected $fillable = [
        'sender_id',
        'content'
    ];
    
    public function sender()
    {
        return $this->belongsTo(\App\Models\Client::class, 'sender_id');
    }

    public function conversation()
    {
        return $this->belongsTo(\App\Models\Conversation::class);
    }

    public function getContentTextAttribute()
    {
        if(strlen($this->content) > self::TRUNCATE_LENGTH)
        {
            return substr($this->content, 0, self::TRUNCATE_LENGTH)  . "<br>" . "<a href='" . route('client.conversations.show', $this->conversation->id) . "'>See More</a>";
        }

        return $this->content;
    }
}
