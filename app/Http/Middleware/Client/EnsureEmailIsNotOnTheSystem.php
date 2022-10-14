<?php

namespace App\Http\Middleware\Client;

use App\Models\Client;
use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsNotOnTheSystem
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
        $client = Client::where('email', $request->input('email'))->first(); 

        if($client)
        {
            return redirect()->back()
                  ->withErrors('Cannot add contact since the email exist on our system.Please try to search and connect instead.');
        }
        
        return $next($request);
    }
}
