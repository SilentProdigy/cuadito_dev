<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ConversationSubscription;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function inbox()
    {
        $conversation_subscriptions = ConversationSubscription::whereHas('conversation.messages', function($query) {
            $query->where('sender_id', "!=", auth('client')->user()->id );
        }, ">", 0)
        ->where('client_id', auth('client')->user()->id )
        ->where('is_archived', false)
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('client.inbox.inbox')->with(compact('conversation_subscriptions'));
    }

    public function starred()
    {
        $conversation_subscriptions = ConversationSubscription::whereHas('conversation.messages', function($query) {
            $query->where('sender_id', "!=", auth('client')->user()->id );
        }, ">", 0)
        ->where('client_id', auth('client')->user()->id )
        ->where('is_archived', false)
        ->where('is_starred', true)
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('client.inbox.starred')->with(compact('conversation_subscriptions'));
    }

    public function archived()
    {
        $conversation_subscriptions = ConversationSubscription::whereHas('conversation.messages', function($query) {
            $query->where('sender_id', "!=", auth('client')->user()->id );
        }, ">", 0)
        ->where('client_id', auth('client')->user()->id )
        ->where('is_archived', true)
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('client.inbox.archived')->with(compact('conversation_subscriptions'));
    }

    public function important()
    {
        $conversation_subscriptions = ConversationSubscription::whereHas('conversation.messages', function($query) {
            $query->where('sender_id', "!=", auth('client')->user()->id );
        }, ">", 0)
        ->where('client_id', auth('client')->user()->id )
        ->where('is_important', true)
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('client.inbox.important')->with(compact('conversation_subscriptions'));
    }

    public function sent()
    {
        
    }
}
