<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BillingController extends Controller
{
    public function create()
    {
        try
        {
            // Check if client wants to buy a new subscription
            // if(auth('client')->user()->have_subscription)
            // {
            //     $active_subsription = auth('client')->user()->active_subscription;
            //     $subscription_date = $active_subsription->created_at;
            //     $min_date = (new Carbon())->subDays(3);

            //     if($subscription_date->isBetween($min_date, new Carbon()))
            //     {
            //         return redirect()->back()->withErrors([
            //             'message' => "Operation failed! You need to wait atleast 3 days to change your current subscription!"
            //         ]);
            //     }
            // }

            // Total Amount = Plan * Months (default is 12)
            // $total_amount = $subscription_type->amount * config('cuadito.payment.default_billable_months_count');

            // $response = Http::retry(3)->withBasicAuth(
            //     config('dragonpay.merchant_id'),
            //     config('dragonpay.password'),
            // )
            // ->get(config("dragonpay.base_url") . "/processors/available/".$total_amount);

            // $payment_channels = $response->collect();

            // $payment_channels = $payment_channels->filter(function($item) {
            //     // $procId = $item['procId'];
            //     // return in_array($procId, config('dragonpay.supported_payment_channels'));
            //     return true;
            // })
            // ->filter(function($item) use($total_amount){
            //     return $total_amount >= $item['minAmount'] && $total_amount < $item['maxAmount'];
            // });
    
            // return view('client.billings.create')->with(compact('subscription_type', 'total_amount', 'payment_channels'));
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: BILLING_CREATE, ERROR:" . $e->getMessage());
            return \redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }
}
