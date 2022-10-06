<?php 

namespace App\Services;

use App\Models\Company;
use App\Models\Project;

class ProjectService 
{
    public function createProject(Company $company, $project_details, $category_ids)
    {
        $project = $company->projects()->create($project_details);
        $project->categories()->sync($category_ids);
        return $project;
    }

    public function updateProject(Project $project, $project_details, $category_ids)
    {
        $project->update($project_details);
        $this->syncCategories($project, $category_ids);
        return $project;
    }

    public function syncCategories(Project $project, $category_ids)
    {
        $project->categories()->sync($category_ids);
    }
}