<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\Subscription\PaymentCreated;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use App\Traits\SendEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    use SendEmail;

    public function subscribe(SubscriptionType $subscription_type)
    {
        try
        {
            DB::beginTransaction();            

            $amount = $subscription_type->amount * 1;
            $vat = $amount * 0.12; 
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

            // call the DRAGONPAY API
            // if the payment was successful from the dragonpay api return result

            // activate subscription & save payment
            $expiration_date = new Carbon();
            $expiration_date = $expiration_date->addMonth();

            $subscription->update([
                'status' => Subscription::ACTIVE_STATUS,
                // 'points' => $subscription_type->points,
                'submitted_proposals_count' => 0,
                'submitted_projects_count' => 0,
                'expiration_date' => $expiration_date
            ]);            
            
            $payment = $subscription->payments()->create([
                'amount' => $amount, // amount here comes from the api of dragon pay
                'additional_vat' => $vat,
                'total_amount' => $total_amount,
                'mode_of_payment' => 'Mastercard',
                'details' => 'Lorem ipsum dulum'
            ]);

            $subscription->client->notifications()->create([
                'content' => "You have paid P{$payment->amount} to purchase {$subscription->subscription_type->name} on {$payment->created_at->format('m-d-Y')}.",
                'url' => route('client.products.index'), 
            ]);

            $this->sendEmail($subscription->client->email, new PaymentCreated($payment,$subscription));
            
            DB::commit();
            
            return redirect(route('client.invoice.show', $payment))->with('success', 'You are now successfully subscribed!');
        }
        catch(\Exception $e)
        {

            return $e->getMessage();
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
