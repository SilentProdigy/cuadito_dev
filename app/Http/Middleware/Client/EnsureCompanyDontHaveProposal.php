<?php

namespace App\Http\Middleware\Client;

use App\Traits\CheckIfCompanyHasProposalToProject;
use Closure;
use Illuminate\Http\Request;

class EnsureCompanyDontHaveProposal
{
    use CheckIfCompanyHasProposalToProject;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($this->checkIfCompanyHasProposalToProject($request->project))
        {
            return redirect()->back()->withErrors([
                'message' => 'You already submitted a proposal for this project!'
            ]);
        }

        return $next($request);
    }
}
