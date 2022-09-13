<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationSubscription extends Model
{
    use HasFactory;


    // protected $appends = ['subject'];

    protected $fillable = [
        'client_id',
        'conversation_id',
        'is_starred',
        'is_trashed',
        'is_important',
        'is_archived',
    ];

    protected $with = [
        'conversation',
        'labels'
    ];

    public function conversation()
    {
        return $this->belongsTo(\App\Models\Conversation::class);
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function getSubjectAttribute()
    {
        return $this->conversation->subject;
    }

    public function labels()
    {
        return $this->belongsToMany(\App\Models\Label::class, 'conversation_sub_label', 'conversation_subscription_id', 'label_id');
    }

    // public function messages()
    // {
    //     return $this->hasManyThrough(\App\Models\Message::class, \App\Models\Conversation::class);
    // }

    public function getLatestMessageDateAttribute()
    {
        return $this->conversation->messages()->latest()->first()->created_at;
    }
}
