<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\CheckIfClientOwnedAProject;
use App\Traits\CheckIfCompanyHasProposalToProject;
use Carbon\Carbon;
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
                $query->where('title', 'LIKE',  '%'. request('search') . '%');
            });
        }
        elseif(request()->has('adv_search'))
        {
            $projects = $projects
                        ->where(request('filter_col'), 'LIKE', '%'.request('filter_val') . '%')
                        ->orderBy(request()->input('sort_col'), request()->input('sort_val'));
        }

        $projects = $projects->with('categories')
                    ->where('status', Project::ACTIVE_STATUS)
                    ->where('due_date', '>', Carbon::today());
        
        if(!request()->has('sort_col') && request()->input('sort_col') != "")
        {
            $projects = $projects->orderBy('created_at', 'desc');
        }

        $projects = $projects->paginate(5);

        $search_options = [
            'filter_cols' => [
                ['label' => 'Title', 'value' => 'title'],
                ['label' => 'Scope of Work','value' => 'scope_of_work'], 
                ['label' => 'Cost', 'value' => 'cost']
            ], 
            'sort_by_cols' => [
                ['label' => 'Title', 'value' => 'title'],
                ['label' => 'Scope of Work','value' => 'scope_of_work'], 
                ['label' => 'Cost', 'value' => 'cost'],
                ['label' => 'Date Posted', 'value' => 'created_at']
            ]
        ];

        return view('client.listing.index')->with(compact('projects', 'search_options'));
    }

    public function show(Project $project)
    { 
        $is_owned_project = $this->checkIfClientOwnedAProject($project);
        $has_proposal = $this->checkIfCompanyHasProposalToProject($project);
        return view('client.listing.show')->with(compact('project', 'has_proposal', 'is_owned_project'));
    }
}
