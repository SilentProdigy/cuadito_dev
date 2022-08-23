<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Messages\CreateMessageFormRequest;
use App\Models\Company;
use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(CreateMessageFormRequest $request, Conversation $conversation)
    {
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

        return redirect()->back()->with('success', 'Message was successfully sent.');     
    }
}