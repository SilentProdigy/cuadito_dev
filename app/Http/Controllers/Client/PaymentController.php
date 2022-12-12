<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
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

        $payments = $payments->paginate();

        return view('client.payments.index')->with(compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('client.payments.show')->with(compact('payment'));
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
