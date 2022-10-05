<?php 
namespace App\Traits\Middleware;
trait CheckIfClientReachedMaxAllowedCompanies 
{
    public function checkIfClientReachedMaxAllowedCompanies() : bool
    {
        return $this->reachedMaxCompanies();
    }

    private function reachedMaxCompanies() : bool
    {
        return auth('client')->user()->companies->count() == config('client.max_companies_count');
    }
} 