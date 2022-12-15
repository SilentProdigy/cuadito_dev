<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\Subscription\PaymentCreated;
use App\Models\Payment;
use App\Models\Subscription;
use App\Traits\SendEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    use SendEmail;

    public function store(Request $request)
    {
        // $status_code = [
        //     'S' => 'Success',
        //     'F' => 'Failure',
        //     'P' => 'Pending',
        //     'U' => 'Unknown',
        //     'R' => 'Refund',
        //     'K' => 'Chargeback',
        //     'V' => 'Void',
        //     'A' => 'Authorized'
        // ];

        try
        {
            DB::beginTransaction();

            if($request->input('status') != 'S')
            {
                Log::error('Payment unsuccessful');
                return;
            }
    
            $payment = Payment::findOrFail($request->input('txnid'));
    
            $payment->update([
                'reference_no' => $request->input('refno'),
                'amount' => $request->input('amount'),
                'total_amount' => $request->input('amount'),
                'payment_method' => $request->input('procid'),
                'status' => Payment::PAID_STATUS,
                'paid_at' => Carbon::now()
            ]);
    
            $subscription = $payment->subscription;


    
            $expiration_date = new Carbon();
            $expiration_date = $expiration_date->addMonth();
    
            $subscription->update([
                'status' => Subscription::ACTIVE_STATUS,
                // 'points' => $subscription_type->points,
                'submitted_proposals_count' => 0,
                'submitted_projects_count' => 0,
                'expiration_date' => $expiration_date
            ]);  

            $subscription->client->notifications()->create([
                'content' => "You have paid P{$payment->amount} to purchase {$subscription->subscription_type->name} Plan on {$payment->created_at->format('m-d-Y')}.",
                'url' => route('client.payments.show', $payment), 
            ]);
    
            $this->sendEmail($subscription->client->email, new PaymentCreated($payment,$subscription));
            
            DB::commit();
            Log::info($payment);
            return response()->json(['result' => 'OK']);
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
}
