<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Http\Request;

class EnsureClientHaveValidCompanies
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
        if(!auth('client')->user()->have_companies)
            return redirect(route('client.companies.index'))->withErrors('Invalid operation! Please register a company first.');

        if(!auth('client')->user()->have_valid_companies)
            return redirect(route('client.companies.index'))->withErrors('Invalid operation! Make sure that you have approved companies.');

        return $next($request);
    }
}
