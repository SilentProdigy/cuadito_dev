<?php 

namespace App\Services;

class CompanyService 
{
    public function getApprovedCompaniesOfClient()
    {
        return auth('client')->user()->companies()->approved()->get();
    }
}