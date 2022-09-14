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

    protected $appends = ['latest_message', 'have_unread_messages'];

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\ConversationSubscription::class);
    }

    public function getLatestMessageAttribute()
    {
        return $this->messages()->latest()->first();
    }

    public function getOtherClientAttribute()
    {
        $subscription = $this->subscriptions()->where('client_id','!=',auth('client')->user()->id)->first();

        // The other person on the conversation delete the convo!
        if(!$subscription) {
            $subscription = $this->subscriptions()->withTrashed()
                            ->where('client_id','!=',auth('client')->user()->id)
                            ->first();
        }

        return $subscription->client;
    }

    public function getHaveUnreadMessagesAttribute()
    {
        return $this->messages()->where([
            ['read',false], 
            ['sender_id','!=',auth('client')->user()->id] 
        ])
        ->count() > 0;
    }

    public function unreadMessages()
    {
        return $this->messages()->where('read',false);
    }
}
