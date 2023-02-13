<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Messages\CreateMessageFormRequest;
use App\Mail\Message\NotifyReceiver;
use App\Models\Company;
use App\Models\Conversation;
use App\Models\Notification;
use App\Traits\SendEmail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    use SendEmail;

    public function store(CreateMessageFormRequest $request, Conversation $conversation)
    {
        DB::beginTransaction();
        
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

            $this->sendEmail(
                [$recipient->email], 
                new NotifyReceiver(auth('client')->user(), $recipient, $conversation)
            );

            DB::commit();
    
            return redirect()->back()->with('success', 'Message was successfully sent.');     
        } catch (Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            
            Log::error('MESSAGE_CREATE_FAILED: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }
}