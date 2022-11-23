<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function unsubscribe(Subscription $subscription)
    {
        try
        {
            $subscription->update(['status' => Subscription::INACTIVE_STATUS]);
            
            // cancel recurring payments option on dragon pay
            return redirect(route('client.dashboard'))->with('success', 'You are now successfully unsubscribed!');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
