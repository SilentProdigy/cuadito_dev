<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Project\UpdateProjectStatusRequest;
use App\Models\Bidding;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectListingController extends Controller
{
    public function index()
    {
        $projects = Project::query()
                    ->when(request('search'), function($query) {
                        $query->where('title', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('description', 'LIKE', '%' . request('search') . '%');
                    })
                    ->with('categories')
                    ->orderBy('id', 'desc')
                    ->paginate(Project::ITEMS_PER_PAGE);
        
        $project_states = Project::PROJECT_STATES;

        return view('admin.projects.index')->with(compact('projects', 'project_states'));
    }

    public function show(Project $project)
    {
        $proposals = Bidding::where('project_id', $project->id);
        
        if(request('search'))
        {
            $proposals->where('rate', 'LIKE', '%' . request('search') . '%')            
            ->orWhereHas('company', function($query) {
                $query->where('name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('email', 'LIKE', '%' . request('search') . '%');
            });
        }

        $proposals = $proposals->paginate(10);

        return view('admin.projects.show')->with(compact('project', 'proposals'));
    }   

    public function setStatus(UpdateProjectStatusRequest $request, Project $project)
    {
        try 
        {
            // TODO: Additional business logic here ...
            $project->update($request->all());
            return redirect(route('admin.projects.index'))->with('success', 'Project status was successfully set.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
