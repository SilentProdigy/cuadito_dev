<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ConversationSubscription;
use App\Models\Label;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConversationSubscriptionController extends Controller
{
    public function update(Request $request, ConversationSubscription $conversationSubscription)
    {
        DB::beginTransaction();
        try
        {
            $conversationSubscription->update($request->all());
            DB::commit();
            return redirect(route('client.inbox.index'));     
        }
        catch(\Exception $e)
        {
            Log::error('ACTION: CONVERSATION_SUBSCRIPTION_UPDATE_FAILED, ERROR: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }

    public function star()
    {
        DB::beginTransaction();
        try
        {   
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
                $item->update([
                    'is_starred' => request()->input('star') == "true" 
                ]);
            });
            DB::commit();
            return redirect(route('client.inbox.index'));     
        }
        catch(\Exception $e)
        {
            Log::error('ACTION: CONVERSATION_SUBSCRIPTION_STAR_FAILED, ERROR: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }

    public function archive()
    {
        DB::beginTransaction();
        try
        {  
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
                $item->update([
                    'is_archived' => request()->input('archived') == 'true'
                ]);
            });
            DB::commit();
            return redirect(route('client.inbox.index'));     
        }
        catch(\Exception $e)
        {
            Log::error('ACTION: CONVERSATION_SUBSCRIPTION_ARCHIVED_FAILED, ERROR: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }

    public function destroy()
    {
        DB::beginTransaction();
        try
        {
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
               $item->delete();
            });

            DB::commit();
            // return redirect(route('client.inbox.index'))->with('success', 'Conversation was deleted!');     
            return redirect(route('client.inbox.index'));
        }
        catch(\Exception $e)
        {
            Log::error('ACTION: CONVERSATION_SUBSCRIPTION_DELETE_FAILED, ERROR: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }

    public function important()
    {
        DB::beginTransaction();
        try
        {
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) {
                $item->update([
                    'is_important' => request()->input('important') == 'true'
                ]);
            });
            DB::commit();
            return redirect(route('client.inbox.index'));     
        }
        catch(\Exception $e)
        {
            Log::error('ACTION: CONVERSATION_SUBSCRIPTION_IMPORTANT_FAILED, ERROR: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }

    public function unread()
    {
        DB::beginTransaction();

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
            DB::commit();
            return redirect(route('client.inbox.index'));     
        }
        catch(\Exception $e)
        {
            Log::error('ACTION: CONVERSATION_SUBSCRIPTION_UNREAD_FAILED, ERROR: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
        }
    }

    public function setLabel(Request $request)
    {
        DB::beginTransaction();
        try
        {
            ConversationSubscription::whereIn('id', $this->getSubscriptionIds())->get()
            ->each(function($item) use($request) {
                $labels = Label::whereIn('id', $request->input('labels'))->get();
                $item->labels()->sync($labels);
            });

            DB::commit();
            return redirect()->back();
        }
        catch(\Exception $e)
        {
            Log::error('ACTION: CONVERSATION_SUBSCRIPTION_SET_LABEL_FAILED, ERROR: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Something went wrong!' => 'An unexpected error occured'
            ]);
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
