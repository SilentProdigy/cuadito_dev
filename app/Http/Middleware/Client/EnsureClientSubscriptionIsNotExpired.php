<?php

namespace App\Http\Middleware\Client;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class EnsureClientSubscriptionIsNotExpired
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
        $subscription = auth('client')->user()->active_subscription;

        if($subscription) 
        {
            // Have lifetime-subscription
            if($subscription->expiration_date == null)
            {
                return $next($request);
            }

            $expiration_date = $subscription->expiration_date;
            $today = Carbon::now();

            if($expiration_date->lessThanOrEqualTo($today))
            {
                return redirect(route('client.products.index'))->withErrors([
                    'Invalid Operation' => "You're subscription is expired!"
                ]);
            }
        }

        return $next($request);
    }
}
