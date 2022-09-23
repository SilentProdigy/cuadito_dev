<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Project\UpdateProjectStatusRequest;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectListingController extends Controller
{
    public function index()
    {
        $projects = Project::get();
        $project_states = Project::PROJECT_STATES;

        return view('admin.projects.index')->with(compact('projects', 'project_states'));
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
