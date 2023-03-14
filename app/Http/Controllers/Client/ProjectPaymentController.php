<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\BidRule;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProjectPaymentController extends Controller
{
    public function create(Project $project)
    {
        // NOTE: DP is not accepting values with decimal point!
        // $payment_type =  PaymentType::findOrFail(PaymentType::PAYMENT_FOR_PROPOSAL_ID);
        
        $total_amount = 0;
        $cost = $project->cost;

        $total_amount = $project->computeTotalAmount();

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

        return view('client.billings.create_proposal_payment')->with(compact('total_amount', 'payment_channels', 'project'));
    }

    public function store(Request $request, Project $project)
    {
        try
        {
            $request->validate([
                'payment_channel' => 'required'
            ]);

            DB::beginTransaction();        
            
            $total_amount = $project->computeTotalAmount();
            
            $payment = $project->payment()->create([
                'amount' => $total_amount, // amount here comes from the api of dragon pay
                'total_amount' => $total_amount,
                'details' => "View Project's proposals fee",                
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
                                'Description' => "View Project's proposals fee",
                                'Email' => auth('client')->user()->email,
                                'Param1' => config('dragonpay.secret'),
                                'Param2' => "PROJECT_" . $project->id,
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
            Log::error("ACTION: CREATE_PAYMENT, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }
}
