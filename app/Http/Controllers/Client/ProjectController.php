<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Project\UpdateProjectStatusRequest;
use App\Models\Company;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $projects = auth('client')->user()->projects ?? [];
        $project_states = Project::PROJECT_STATES;
        return view('client.projects.index')->with(compact('projects', 'project_states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: Add some more business logic here...
        $companies = auth('client')->user()->companies->where('validation_status', Company::APPROVED_STATUS);
        return view('client.projects.create')->with(compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $company = Company::find($request->input('company_id'));
            $company->projects()->create($request->except(['company_id']));
            // auth('client')->user()->projects()->create($request->all());
            return redirect(route('client.projects.index'))->with('success', 'Project was successfully created & posted.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $companies = auth('client')->user()->companies;
        
        return view('client.projects.edit')->with(compact('project', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        try 
        {
            // TODO: Additional business logic here ...
            $project->update($request->all());
            return redirect(route('client.projects.index'))->with('success', 'Project was successfully updated.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try 
        {
            // TODO: Additional business logic here ...
            $project->delete();
            return redirect(route('client.projects.index'))->with('success', 'Project was successfully deleted.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function setStatus(UpdateProjectStatusRequest $request, Project $project)
    {
        try 
        {
            // TODO: Additional business logic here ...
            $project->update($request->all());
            return redirect(route('client.projects.index'))->with('success', 'Project status was successfully set.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
