<?php

namespace App\Http\Middleware\Client;

use App\Traits\Middleware\CheckIfClientReachedMaxAllowedComapnies;
use Closure;
use Illuminate\Http\Request;

class EnsureClientDidNotReachMaxCompanies
{
    use CheckIfClientReachedMaxAllowedComapnies;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
   public function handle(Request $request, Closure $next)
    {
        if($this->checkIfClientReachedMaxAllowedCompanies()) {
            return redirect()->back()->withErrors([
                'Invalid Operation' => 'Reached the max count of companies!'
            ]);
        }

        return $next($request);
    }

}
