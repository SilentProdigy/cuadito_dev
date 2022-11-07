<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Payment $payment)
    {
        $payment->load('subscription');

        $subscription_type = $payment->subscription->subscription_type;
        
        return view('client.invoices.show')->with(compact('payment', 'subscription_type'));
    }
}
