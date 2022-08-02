<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\CheckIfCompanyHasProposalToProject;
use Illuminate\Http\Request;


class ProjectListingController extends Controller
{
    use CheckIfCompanyHasProposalToProject;

    public function index()
    {   
        $projects = Project::query()
                    ->when(request('search'), function($query) {
                        $query->where('title', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('description', 'LIKE', '%' . request('search') . '%');
                    })
                    ->with('categories')
                    ->where('status', Project::ACTIVE_STATUS)
                    ->orderBy('id', 'desc')
                    ->paginate(5);

        $companies = auth('client')->user()->companies;                    
        return view('client.listing.index')->with(compact('projects', 'companies'));
    }

    public function show(Project $project)
    { 
        $is_owned_project = $project->owner->id == auth('client')->user()->id;
        $has_proposal = $this->checkIfCompanyHasProposalToProject($project);
        return view('client.listing.show')->with(compact('project', 'has_proposal', 'is_owned_project'));
    }
}
