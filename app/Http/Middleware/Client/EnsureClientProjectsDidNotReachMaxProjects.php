<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Http\Request;

class EnsureClientProjectsDidNotReachMaxProjects
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
        $product = $subscription->subscription_type;

        if($subscription->submitted_projects_count + 1 > $product->max_projects_count)
        {
            // return redirect()->back()->withErrors(["message" => "Operation Failed! You reached the max projects for your plan!"]);
            return redirect(route('client.products.index'))->withErrors(["message" => "Operation Failed! You reached the max projects for your plan!"]);
        }

        return $next($request);
    }
}
