<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ConversationSubscription;
use App\Models\Label;
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

    public function star()
    {
        try
        {   
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
                $item->update([
                    'is_starred' => request()->input('star') == "true" 
                ]);
            });
            
            return redirect(route('client.inbox.index'));     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function archive()
    {
        try
        {  
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
                $item->update([
                    'is_archived' => request()->input('archived') == 'true'
                ]);
            });

            return redirect(route('client.inbox.index'));     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function destroy()
    {
        try
        {
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
               $item->delete();
            });

            // return redirect(route('client.inbox.index'))->with('success', 'Conversation was deleted!');     
            return redirect(route('client.inbox.index'));
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function important()
    {
        try
        {
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
                $item->update([
                    'is_important' => request()->input('important') == 'true'
                ]);
            });

            return redirect(route('client.inbox.index'));     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function unread()
    {
        try
        {
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
                $conversation = $item->conversation;
            
                $latest_message = $conversation
                                ->messages()
                                ->where('sender_id', '!=', auth('client')->user()->id)
                                ->latest()
                                ->first();

                $latest_message->update(['read' => false]);
            });
    
            return redirect(route('client.inbox.index'));     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function setLabel(Request $request)
    {
        try
        {
            ConversationSubscription::where('id', $request->input('subscription_ids'))->get()
            ->each(function($item) use($request) {
                $labels = Label::whereIn('id', $request->input('labels'))->get();
                $item->labels()->sync($labels);
            });

            // $subscription->labels()->sync($request->input('labels'));
            
            // $labels->each(function($item) use($subscription) {
            //     ConversationSubLabel::create([
            //         'label_id' => $item->id,
            //         'conversation_subscription_id' => $subscription->id
            //     ]);
            // });

            return redirect()->back();
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
    private function getSubscriptionIds()
    {
        $ids = request()->input('subscription_ids'); 

        $ids = explode(",", $ids);

        if(!$ids)
            abort(404);        

        return $ids;
    }
}
