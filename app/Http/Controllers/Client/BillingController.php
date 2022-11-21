<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function create(SubscriptionType $subscription_type)
    {
        $total_amount = $subscription_type->amount * 1;
        return view('client.billings.create')->with(compact('subscription_type', 'total_amount'));
    }

    public function store(SubscriptionType $subscription_type)
    {
        try
        {
            DB::beginTransaction();

            $subscription = auth('client')->user()->latest_subscription;

            $amount = $subscription_type->amount * 1;
            $vat = $amount * 0.12; 
            $total_amount = $vat + $amount;

            $expiration_date = new Carbon();
            $expiration_date = $expiration_date->addMonth();

            // Check if the client is buying same product - renew subscription
            if($subscription->subscription_type_id == $subscription_type->id) 
            {
                $subscription->update([
                    'expiration_date' => $expiration_date,
                    'status' => Subscription::ACTIVE_STATUS,
                    'points' => $subscription->points + $subscription_type->points
                ]);
            }
            else 
            {
                $subscription->update(['status' => Subscription::INACTIVE_STATUS]);

                $subscription = auth('client')->user()->subscriptions()->create([
                    'subscription_type_id' => $subscription_type->id,
                    'expiration_date' => $expiration_date,
                    'status' => Subscription::ACTIVE_STATUS,
                    'points' => $subscription_type->points
                ]);
            }  
                        
            $payment = $subscription->payments()->create([
                'amount' => $amount, // amount here comes from the api of dragon pay
                'additional_vat' => $vat,
                'total_amount' => $total_amount,
                'mode_of_payment' => 'GCASH',
                'details' => 'Lorem ipsum dulum'
            ]);

            DB::commit();
            
            return redirect(route('client.invoice.show', $payment))->with('success', 'You are now successfully subscribed!');
        }
        catch(\Exception $e)
        {
            DB::rollBack();

            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
