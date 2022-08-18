<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $conversation_subscriptions = auth('client')->user()->conversationSubscriptions()
                                    ->where('is_archived', false)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(5);
        // return $conversation_subscriptions;

        return view('client.conversations.index')->with(compact('conversation_subscriptions'));
    }

    public function show(Conversation $conversation)
    {
        $messages = $conversation->messages;

        return view('client.conversations.show')->with(compact('messages', 'conversation'));
    }

    public function create()
    {
        return view('client.conversations.create');
    }

    public function store(Request $request)
    {
        $recipient = Client::where('email', $request->input('email'))->first();
        
        # Create conversation
        $conversation = Conversation::create(['subject' => $request->input('subject')]);

        # Subscribe client to conversation
        collect([ auth('client')->user(), $recipient ])->each(function($item) use ($conversation){
            $conversation->subscriptions()->create([
                'client_id' => $item->id,
                'conversation_id' => $conversation->id,
            ]);
        });

        # Create messages for the conversation
        $conversation->messages()->create([
            'sender_id' => auth('client')->user()->id,
            'content' => $request->input('content')
        ]);

        $recipient->notifications()->create([
            'content' => auth('client')->user()->name . ' messaged you!',
            'url' => route('client.conversations.show', $conversation),    
        ]);

        return redirect(route('client.conversations.index'))->with('success', 'Successfuly sent a message!');     
    }
}
