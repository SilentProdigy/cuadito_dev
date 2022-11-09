<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Http\Request;

class EnsureClientHaveSubscriptionPoints
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
        $client = auth('client')->user();
        
        $subscription = $client->active_subscription;

        if($subscription->points <= 0) {
            return redirect()->back()->withErrors([
                'Invalid Operation' => "Ooops! You don't have enough points to submit this proposal!"
            ]);
        }

        return $next($request);
    }
}
