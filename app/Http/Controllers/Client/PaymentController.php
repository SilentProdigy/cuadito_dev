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
        $payments = auth('client')->user()->payments()->paginate();

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
