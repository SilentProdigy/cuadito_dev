<?php 

namespace App\Traits;

use App\Models\Project;

trait CheckIfCompanyHasProposalToProject 
{
    public function checkIfCompanyHasProposalToProject(Project $project): bool
    {
        return $project->biddings()->where('company_id' , session('config.company'))->exists();
    }
}