<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public const MESSAGE_NOTIFICATION_TYPE = 'message_notification';

    protected $fillable = [
        'client_id',
        'content',
        'url',
        'opened',
        'notifiable_id',
        'notifiable_type',
        'type'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function scopeClose($query)
    {
        return $query->where('opened', '!=' , true);
    }

    public function scopeMessageType($query)
    {
        return $query->where('type', self::MESSAGE_NOTIFICATION_TYPE);
    }

    public function openNotification()
    {
        $this->update(['opened' => true]);
    }
}
