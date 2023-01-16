<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\Subscription\PaymentCreated;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use App\Traits\SendEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    use SendEmail;

    public function subscribe(Request $request,SubscriptionType $subscription_type)
    {
        try
        {
            $request->validate([
                'payment_channel' => 'required'
            ]);

            DB::beginTransaction();            

            $billed_months_count = config('cuadito.payment.default_billable_months_count');

            $amount = $subscription_type->amount * $billed_months_count;
            $vat = $amount * config('cuadito.payment.vat_percentage');
            $total_amount = $vat + $amount;

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


            $payment = $subscription->payments()->create([
                'amount' => 0, // amount here comes from the api of dragon pay
                'total_amount' => 0,
                'details' => 'Payment for ' . $subscription->subscription_type->name . ' plan',                
                'period' =>  $billed_months_count. " months",
                'status' => Payment::PENDING_STATUS,
                'client_id' => auth( 'client')->user()->id,
            ]);

            // Request for payment
            $response = Http::retry(3)->withBasicAuth(
                            config('dragonpay.merchant_id'),
                            config('dragonpay.password'),
                        )
                        ->withHeaders([
                            'Content-Type' => 'application/json'
                        ])
                        ->post(config("dragonpay.base_url") . "/". $payment->id ."/post", [
                                'Amount' => $total_amount,
                                'Currency' => config('dragonpay.currency'),
                                'Description' => "Payment for {$subscription_type->name} Plan",
                                'Email' => auth('client')->user()->email,
                                'Param1' => config('dragonpay.secret'),
                                'ProcId' => $request->input('payment_channel')
                            ],
                        );

            DB::commit();
            
            if($response['Status'] !== "S")
            {
                return redirect()->back()->withErrors(['message' => 'Operation Failed: ' . $response['Message']]);
            }
            
            // Redirect to Submitted URL
            return redirect($response['Url']);
        }
        catch(\Exception $e)
        {
            // return $e->getMessage();
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

    public function renew(Subscription $subscription)
    {
        DB::beginTransaction();

        try
        {
            $expiration_date = new Carbon();
            $expiration_date = $expiration_date->addMonth();

            $active_subscription = auth('client')->user()->active_subscription;
            $active_subscription->update([
                'submitted_proposals_count' => 0,
                'submitted_projects_count' => 0,
                'expiration_date' => $expiration_date
            ]); 

            DB::commit();
            return redirect(route('client.dashboard'))->with('success', 'You successfully renewed your plan!');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);    
        }
    }
}
