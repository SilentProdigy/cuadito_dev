<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\Subscription\PaymentCreated;
use App\Models\Payment;
use App\Models\Subscription;
use App\Traits\SendEmail;
use Barryvdh\DomPDF\Facade\Pdf;


class PaymentController extends Controller
{
    use SendEmail;

    public function index()
    {
        $payments = Payment::with(['subscription', 'subscription.subscription_type'])
                    ->where('client_id', auth('client')->user()->id);

        if(request()->input('search'))
        {
            $payments = $payments->where(function($query) {
                $query->where('id', 'LIKE' , "%". request()->input('search') ."%")
                ->orWhere('or_number', 'LIKE' , "%". request()->input('search') ."%");
            });
        }   

        // $payments = $payments->paginate();
        $payments = $payments->latest()->get();

        return view('client.payments.index')->with(compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('client.payments.show')->with(compact('payment'));
    }

    public function result()    
    {
        if(request()->input('txnid'))
        {
            $payment = Payment::findOrFail(request()->input('txnid'));
            
            $dragon_pay_status_codes = config('dragonpay.status_codes');
            $reference_no = request()->input('refno');
            $amount = request()->input('amount');
            $payment_method = request()->input('procid');
            $total_amount = request()->input('amount');
            $status = $dragon_pay_status_codes[request()->input('status')];

            return view('client.payments.result')->with(compact('payment', 'reference_no', 'amount', 
                        'total_amount', 'payment_method', 'status'));
        }

        return redirect(route('client.payments.index'))->withErrors([
            'message' => 'Unexpected Error Occured!',
        ]);
    }

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
