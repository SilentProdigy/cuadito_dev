<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Http\Request;
use App\Traits\Middleware\CheckIfEmailIsInContactList;

class EnsureEmailIsNotOnContactList
{
    use CheckIfEmailIsInContactList;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle(Request $request, Closure $next)
    {
        if($this->checkIfEmailIsInContactList(request()->input('email')))
        {
            return redirect()->back()->withErrors('Email already exist in your contact list!');
        }

        return $next($request);
    }
}
