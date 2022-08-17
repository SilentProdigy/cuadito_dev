<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ConversationSubscription;
use Exception;
use Illuminate\Http\Request;

class ConversationSubscriptionController extends Controller
{
    public function update(Request $request, ConversationSubscription $conversationSubscription)
    {
        try
        {
            $conversationSubscription->update($request->all());
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function archive(Request $request, ConversationSubscription $conversationSubscription)
    {
        try
        {
            $conversationSubscription->update([
                'is_archived' => true
            ]);

            return redirect(route('client.conversations.index'))->with('success', 'Conversation was archived!');     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
