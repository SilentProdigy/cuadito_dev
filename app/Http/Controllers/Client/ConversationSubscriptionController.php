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

    public function star(Request $request, ConversationSubscription $conversationSubscription)
    {
        try
        {

            $conversationSubscription->update([
                'is_starred' => $request->input('star') == "true" 
            ]);

            // return redirect(route('client.conversations.index'))->with('success', 'Conversation was starred!');     
            return redirect(route('client.inbox.index'));     
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
                'is_archived' => $request->input('archived') == 'true'
            ]);

            return redirect(route('client.inbox.index'));     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function destroy(Request $request, ConversationSubscription $conversationSubscription)
    {
        try
        {
            $conversationSubscription->delete();
            return redirect(route('client.inbox.index'))->with('success', 'Conversation was deleted!');     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function important(Request $request, ConversationSubscription $conversationSubscription)
    {
        try
        {
            $conversationSubscription->update([
                'is_important' => $request->input('important') == 'true'
            ]);

            return redirect(route('client.inbox.index'));     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
