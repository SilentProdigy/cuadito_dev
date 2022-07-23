<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Http\Request;

class EnsureGlobalCompanyIsSet
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
        if(!session('config.company')) 
        {
            if(auth('client')->user()->have_valid_companies) 
                session(['config.company' => auth('client')->user()->company->id]);
            else 
                return redirect()->back()->withErrors("Operation Denied: You don't have valid companies!");
        }
        
        return $next($request);
    }
}
