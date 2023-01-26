<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Http\Request;

class RedirectIfHavePendingTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('dragonpay.payment'))
        {
            // Came from the dragonpay api
            if($request->has('txnid') && $request->has('status'))
            {
                // if paid , cancelled, 
                session()->forget('dragonpay.payment');
                return redirect(route('client.dashboard'));    
            }

            $session = session('dragonpay.payment'); 
            $payment = \App\Models\Payment::find($session['payment']['id']);
            
            if($payment->status == 'Pending')
            {
                return redirect($session['configs']['Url']);
            }
            
            // if paid , cancelled, 
            session()->forget('dragonpay.payment');
            return redirect(route('client.dashboard'));
        }

        return $next($request);
    }
}
