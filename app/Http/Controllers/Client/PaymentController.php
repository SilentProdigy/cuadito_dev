<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\Subscription\PaymentCreated;
use App\Models\Payment;
use App\Models\Subscription;
use App\Traits\SendEmail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    use SendEmail;

    public function index()
    {
        if(request()->input('txnid'))
        {
            $dragon_pay_status_codes = config('dragonpay.status_codes');

            try
            {
                $payment = Payment::findOrFail(request()->input('txnid'));

                $payment->update([
                    'reference_no' => request()->input('refno'),
                    'amount' => request()->input('amount'),
                    'total_amount' => request()->input('amount'),
                    'payment_method' => request()->input('procid'),
                    'status' => $dragon_pay_status_codes[request()->input('status')],
                    'paid_at' => Carbon::now()
                ]);
        
                if(request()->input('status') == 'S')
                {
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
                }
        
                return redirect(route('client.payments.show', $payment))
                        ->with('message', 
                            "Payment was created with status of " . $dragon_pay_status_codes[request()->input('status')
                        ]);
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                return redirect()->back()->withErrors(['message' => $e->getMessage()]);
            }
        }


        $payments = Payment::with(['subscription', 'subscription.subscription_type'])
                    ->where('client_id', auth('client')->user()->id);

        if(request()->input('search'))
        {
            $payments = $payments->where(function($query) {
                $query->where('id', 'LIKE' , "%". request()->input('search') ."%")
                ->orWhere('or_number', 'LIKE' , "%". request()->input('search') ."%");
            });
        }   

        $payments = $payments->paginate();

        return view('client.payments.index')->with(compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('client.payments.show')->with(compact('payment'));
    }

    // public function create()
    // {
    //     $dragon_pay_status_codes = config('dragonpay.status_codes');

    //     try
    //     {
    //         $payment = Payment::findOrFail(request()->input('txnid'));

    //         $payment->update([
    //             'reference_no' => request()->input('refno'),
    //             'amount' => request()->input('amount'),
    //             'total_amount' => request()->input('amount'),
    //             'payment_method' => request()->input('procid'),
    //             'status' => $dragon_pay_status_codes[request()->input('status')],
    //             'paid_at' => Carbon::now()
    //         ]);
    
    //         if(request()->input('status') == 'S')
    //         {
    //             $subscription = $payment->subscription;
            
    //             $expiration_date = new Carbon();
    //             $expiration_date = $expiration_date->addMonth();
        
    //             $subscription->update([
    //                 'status' => Subscription::ACTIVE_STATUS,
    //                 // 'points' => $subscription_type->points,
    //                 'submitted_proposals_count' => 0,
    //                 'submitted_projects_count' => 0,
    //                 'expiration_date' => $expiration_date
    //             ]);  
    
    //             $subscription->client->notifications()->create([
    //                 'content' => "You have paid P{$payment->amount} to purchase {$subscription->subscription_type->name} Plan on {$payment->created_at->format('m-d-Y')}.",
    //                 'url' => route('client.payments.show', $payment), 
    //             ]);
        
    //             $this->sendEmail($subscription->client->email, new PaymentCreated($payment,$subscription));
    //             DB::commit();
    //         }
    
    //         return redirect(route('client.payments.show', $payment))
    //                 ->with('message', 
    //                     "Payment was created with status of " . $dragon_pay_status_codes[request()->input('status')
    //                 ]);
    //     }
    //     catch(\Exception $e)
    //     {
    //         DB::rollBack();
    //         return redirect()->back()->withErrors(['message' => $e->getMessage()]);
    //     }
    // }

    public function print(Payment $payment)
    {
        // $pdf = Pdf::loadView('pdf.invoice', $data);
        $plan = $payment->subscription->subscription_type;
        $subscription = $payment->subscription;
        $client = $subscription->client;
        
        $pdf = Pdf::loadView('client.pdf.invoice', compact(
            'payment',
            'plan',
            'client'
        ));
        
        return $pdf->stream();
    }
}
