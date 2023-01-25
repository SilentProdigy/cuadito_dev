<?php 

namespace App\Traits;

use App\Models\Payment;
use Illuminate\Support\Facades\Session;

trait CreatePaymentSession 
{
    public function createPaymentSession(Payment $payment, $dragonpay_config)
    {
        if(Session::has('dragonpay.payment')) 
        {
            Session::forget('dragonpay.payment');
        }

        session(['dragonpay.payment' => [
            'payment' => $payment->toArray(),
            'configs' => $dragonpay_config
        ]]);
    }
}