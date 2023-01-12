<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BillingController extends Controller
{
    public function create(SubscriptionType $subscription_type)
    {
        try
        {
            // Total Amount = Plan * Months (defaul is 12)
            $total_amount = $subscription_type->amount * config('cuadito.payment.default_billable_months_count');

            $response = Http::retry(3)->withBasicAuth(
                config('dragonpay.merchant_id'),
                config('dragonpay.password'),
            )
            ->get(config("dragonpay.base_url") . "/processors/available/".$total_amount);

            $payment_channels = $response->collect();

            $payment_channels = $payment_channels->filter(function($item) {
                $procId = $item['procId'];
                return in_array($procId, config('dragonpay.supported_payment_channels'));
            })
            ->filter(function($item) use($total_amount){
                return $total_amount >= $item['minAmount'] && $total_amount < $item['maxAmount'];
            });
    
            return view('client.billings.create')->with(compact('subscription_type', 'total_amount', 'payment_channels'));
        }
        catch(\Exception $e)
        {
            return \redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function store(SubscriptionType $subscription_type)
    {
        try
        {
            DB::beginTransaction();            

            $amount = $subscription_type->amount * 1;
            $vat = $amount * 0.12; 
            $total_amount = $vat + $amount;

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
}
