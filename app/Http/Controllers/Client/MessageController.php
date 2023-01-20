<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Messages\CreateMessageFormRequest;
use App\Mail\Message\NotifyReceiver;
use App\Models\Company;
use App\Models\Conversation;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function store(CreateMessageFormRequest $request, Conversation $conversation)
    {
        try {
            $data = [
                'sender_id' => auth('client')->user()->id,
                'content' => $request->input('content')
            ];
    
            $message = $conversation->messages()->create($data);
    
            $conversation->subscriptions
            ->where('client_id', '!=', auth('client')->user()->id)
            ->each(function($item) use ($message) {

                $client = $item->client;
                $message->conversation->notifications()->create([
                    'client_id' => $client->id,
                    'content' => auth('client')->user()->name . ' messaged you!',
                    'url' => route('client.conversations.show', $message->conversation),  
                    'type' => Notification::MESSAGE_NOTIFICATION_TYPE
                ]);
            });
            
            $recipient = $conversation->other_client;

            // NotifyReceiver::dispatch(auth('client')->user(), $recipient, $conversation);
            Mail::to($recipient->email)->queue(new NotifyReceiver(
                auth('client')->user(), 
                $recipient, 
                $conversation
            ));
    
            return redirect()->back()->with('success', 'Message was successfully sent.');     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}