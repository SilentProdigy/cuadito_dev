<?php 

namespace App\Services;

use App\Models\Company;

class CompanyService 
{
    public function getApprovedCompaniesOfClient()
    {
        return auth('client')->user()->companies()->approved()->get();
    }

    public function createProject(Company $company, $project_details, $category_ids)
    {
        $project = $company->projects()->create($project_details);
        $project->categories()->sync($category_ids);
        return $project;
    }
}