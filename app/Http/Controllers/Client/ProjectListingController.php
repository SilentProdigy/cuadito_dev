<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\CheckIfClientOwnedAProject;
use App\Traits\CheckIfCompanyHasProposalToProject;
use Illuminate\Http\Request;


class ProjectListingController extends Controller
{
    use CheckIfCompanyHasProposalToProject, CheckIfClientOwnedAProject;

    public function index()
    {   
        $projects = Project::query();

        // return request()->all();
        
        if(request()->has('search'))
        {
            $projects = $projects->when(request('search'), function($query) {
                $query->where('title', 'LIKE', '%' . request('search') . '%')
                ->orWhere('description', 'LIKE', '%' . request('search') . '%');
            });
        }
        elseif(request()->has('adv_search'))
        {
            /* 
                $projects = $projects->where(function($query) {
                            return $query->where('title', 'LIKE', '%' . request('search') . '%')
                            ->orWhere('description', 'LIKE', '%' . request('search') . '%');
                        })
                        ->orWhere(request('filter_col'), 'LIKE', '%' . request('filter_val') . '%')
                        ->orderBy(request()->input('sort_col'), request()->input('sort_val'));
            */  
            
            $projects = $projects
                        ->where(request('filter_col'), 'LIKE', '%' . request('filter_val') . '%')
                        ->orderBy(request()->input('sort_col'), request()->input('sort_val'));
        }

        $projects = $projects->with('categories')
                    ->where('status', Project::ACTIVE_STATUS);
        
        if(!request()->has('sort_col'))
        {
            $projects = $projects->orderBy('created_at', 'desc');
        }
        

        $projects = $projects->paginate(5);

        return view('client.listing.index')->with(compact('projects'));
    }

    public function show(Project $project)
    { 
        $is_owned_project = $this->checkIfClientOwnedAProject($project);
        $has_proposal = $this->checkIfCompanyHasProposalToProject($project);
        return view('client.listing.show')->with(compact('project', 'has_proposal', 'is_owned_project'));
    }
}
