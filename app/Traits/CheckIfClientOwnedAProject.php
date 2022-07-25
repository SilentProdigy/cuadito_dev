<?php 

namespace App\Traits;

use App\Models\Project;

trait CheckIfClientOwnedAProject 
{
    public function checkIfClientOwnedAProject(Project $project)
    {
        return $project->owner->id == auth('client')->user()->id;
    }
}