<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationSubscription extends Model
{
    use HasFactory;

    protected $table = ['conversation_subscriptions'];

    protected $fillable = [
        'client_id',
        'conversation_id',
        'is_starred',
        'is_trashed',
        'is_important',
        'is_archived',
    ];

    public function conversations()
    {
        return $this->belongsTo(\App\Models\Conversation::class);
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }
}
