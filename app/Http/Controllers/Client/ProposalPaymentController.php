<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class ProposalPaymentController extends Controller
{
    public function create(Bidding $bidding)
    {
        // NOTE: DP is not accepting values with decimal point!
        $payment_type =  PaymentType::findOrFail(PaymentType::PAYMENT_FOR_PROPOSAL_ID);

        $total_amount = (float) $payment_type->amount;

        $target_url = config("dragonpay.base_url") . "/processors/available/".$total_amount;

        $response = Http::retry(3)->withBasicAuth(
            config('dragonpay.merchant_id'),
            config('dragonpay.password'),
        )
        ->get($target_url);

        $payment_channels = $response->collect();

        $payment_channels = $payment_channels->filter(function($item) {
            $procId = $item['procId'];
            return in_array($procId, config('dragonpay.supported_payment_channels'));
        })
        ->filter(function($item) use($total_amount){
            return $total_amount >= $item['minAmount'] && $total_amount < $item['maxAmount'];
        });

        return view('client.billings.create')->with(compact('payment_type', 'total_amount', 'payment_channels'));
    }

    public function subscribe(Request $request,PaymentType $payment_type)
    {
        try
        {
            $request->validate([
                'payment_channel' => 'required'
            ]);

            DB::beginTransaction();            

            $payment_type =  PaymentType::findOrFail(PaymentType::PAYMENT_FOR_PROPOSAL_ID);

            $total_amount = (float) $payment_type->amount;

            $payment = auth('client')->user()->payments()->create([
                'amount' => 0, // amount here comes from the api of dragon pay
                'total_amount' => 0,
                'details' => $payment_type->description,                
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
                                'Description' => $payment_type->description,
                                'Email' => auth('client')->user()->email,
                                'Param1' => config('dragonpay.secret'),
                                // 'Param2' => config('dragonpay.secret'),
                                'ProcId' => $request->input('payment_channel')
                            ],
                        );

            DB::commit();
            
            if($response['Status'] !== "S")
            {
                return redirect()->back()->withErrors(['message' => 'Operation Failed: ' . $response['Message']]);
            }
            
            // $this->createPaymentSession($payment, $response);

            // Redirect to Submitted URL
            return redirect($response['Url']);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            Log::error("ACTION: SUBSCRIBE, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }

}
