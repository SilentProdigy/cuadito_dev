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
    public function subscribe(SubscriptionType $subscription_type)
    {
        try
        {
            DB::beginTransaction();            

            $amount = $subscription_type->amount * 1;
            $vat = $amount * 0.12; 
            $total_amount = $vat + $amount;

            // dd(auth('client')->user()->active_subscription);
            $active_subscription = auth('client')->user()->active_subscription;

            if($active_subscription && $active_subscription?->subscription_type_id != $subscription_type->id) 
            {
                $active_subscription->update([
                    'status' => Subscription::INACTIVE_STATUS
                ]);    
            }

            // Create an inactive subscription
            $subscription = auth('client')->user()->subscriptions()->create([
                'subscription_type_id' => $subscription_type->id,
                'status' => Subscription::INACTIVE_STATUS,
            ]);

            // call the DRAGONPAY API
            // if the payment was successful from the dragonpay api return result

            // activate subscription & save payment
            $expiration_date = new Carbon();
            $expiration_date = $expiration_date->addMonth();

            $subscription->update([
                'status' => Subscription::ACTIVE_STATUS,
                'points' => $subscription_type->points,
                'expiration_date' => $expiration_date
            ]);            
            
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
