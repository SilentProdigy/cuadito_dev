<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Messages\CreateMessageFormRequest;
use App\Mail\Message\NotifyReceiver;
use App\Models\Company;
use App\Models\Conversation;
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
                $item->client->notifications()->create([
                    'content' => auth('client')->user()->name . ' messaged you!',
                    'url' => route('client.conversations.show', $message->conversation),    
                ]);
            });
            
            $recipient = $conversation->other_client;

            // NotifyReceiver::dispatch(auth('client')->user(), $recipient, $conversation);
            Mail::to($recipient->email)->send(new NotifyReceiver(
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