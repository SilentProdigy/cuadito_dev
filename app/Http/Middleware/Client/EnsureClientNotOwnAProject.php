<?php

namespace App\Http\Middleware\Client;

use App\Traits\CheckIfClientOwnedAProject;
use Closure;
use Illuminate\Http\Request;

class EnsureClientNotOwnAProject
{
    use CheckIfClientOwnedAProject;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($this->checkIfClientOwnedAProject($request->project))
        {
            return redirect()->back()->withErrors([
                'message' => "Operation Denied: You can't submit a proposal to your own project!"
            ]);
        }

        return $next($request);
    }
}
