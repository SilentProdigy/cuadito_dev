<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        "subject"
    ];

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\ConversationSubscription::class);
    }
}
