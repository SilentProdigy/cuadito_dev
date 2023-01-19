<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Conversations\CreateConversationFormRequest;
use App\Mail\Message\NotifyReceiver;
use App\Models\Client;
use App\Models\Conversation;
use App\Models\ConversationSubscription;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConversationController extends Controller
{
    public function index()
    {
        $conversation_subscriptions = ConversationSubscription::whereHas('conversation.messages', function($query) {
                $query->where('sender_id', "!=", auth('client')->user()->id );
            }, ">", 0)
            ->where('client_id', auth('client')->user()->id )
            ->where('is_archived', false)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
     
        return view('client.conversations.index')->with(compact('conversation_subscriptions'));
    }

    public function show(Conversation $conversation)
    {
        if($conversation->have_unread_messages)
        {
            $conversation->unreadMessages->each(function($item) {
                $item->update(['read' => true]);
            });

            // Mark notification as read or open
           $conversation->openNotifications();
        }

        $subscription = $conversation->subscriptions->where('client_id', auth('client')->user()->id)->first();

        $subscription->load('labels');

        $messages = $conversation->messages;

        return view('client.conversations.show')->with(compact('messages', 'conversation', 'subscription'));
    }

    public function create()
    {
        return view('client.conversations.create');
    }

    public function store(CreateConversationFormRequest $request)
    {
        try
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
            
            /* 
                $recipient->notifications()->create([
                    'content' => auth('client')->user()->name . ' messaged you!',
                    'url' => route('client.conversations.show', $conversation),    
                    'type' => Notification::MESSAGE_NOTIFICATION_TYPE
                ]);
            */
            
            $conversation->notifications()->create([
                'client_id' => $recipient->id,
                'content' => auth('client')->user()->name . ' messaged you!',
                'url' => route('client.conversations.show', $conversation),    
                'type' => Notification::MESSAGE_NOTIFICATION_TYPE
            ]);
    
            $client = auth('client')->user();

            // NotifyReceiver::dispatch(auth('client')->user(), $recipient, $conversation);
            Mail::to($recipient->email)
            ->queue(new NotifyReceiver(
                $client, 
                $recipient, 
                $conversation
            ));
    
            return redirect(route('client.inbox.index'))->with('success', 'Successfuly sent a message!');     

        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }

    }
}
