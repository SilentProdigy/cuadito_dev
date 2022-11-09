<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            $amount = $subscription_type->amount * 1;
            $vat = $amount * 0.12; 
            $total_amount = $vat + $amount;

            $expiration_date = new Carbon();
            $expiration_date = $expiration_date->addMonth();

            $subscription = auth('client')->user()->subscriptions()->create([
                'subscription_type_id' => $subscription_type->id,
                'expiration_date' => $expiration_date,
                'status' => Subscription::ACTIVE_STATUS,
                'points' => $subscription_type->points
            ]);
            
            $payment = $subscription->payments()->create([
                'amount' => $amount, // amount here comes from the api of dragon pay
                'additional_vat' => $vat,
                'total_amount' => $total_amount,
                'mode_of_payment' => 'GCASH',
                'details' => 'Lorem ipsum dulum'
            ]);
            
            return redirect(route('client.invoice.show', $payment))->with('success', 'You are now successfully subscribed!');
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
