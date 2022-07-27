<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Project\CreateProjectRequest;
use App\Http\Requests\Client\Project\SetProjectWinnerRequest;
use App\Http\Requests\Client\Project\UpdateProjectRequest;
use App\Http\Requests\Client\Project\UpdateProjectStatusRequest;
use App\Models\Bidding;
use App\Models\Company;
use App\Models\Notification;
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
    public function store(CreateProjectRequest $request)
    {
        try 
        {
            $company = Company::find($request->input('company_id'));
            $company->projects()->create($request->except(['company_id']));
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

        return view('client.projects.show')->with(compact('project', 'proposals'));
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
    public function update(UpdateProjectRequest $request, Project $project)
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

    public function setWinner(SetProjectWinnerRequest $request, Project $project)
    {
    
        try 
        {

            $winning_company = Company::findOrFail($request->input('winner_bidding_id'));

            $project->update([
                'status' => Project::CLOSED_STATUS,
                'remarks' => $request->input('remarks'), 
                'winner_bidding_id' => $winning_company->id
            ]);

            $winning_company->client->notifications()->create([
                'content' => "Congratulations! Your proposal for Project - " . $project->title . " - #ID " . $project->id . " was selected!",
                'url' => route('client.projects.show', $project),
            ]);

            return redirect(route('client.projects.index'))->with('success', "Project's winner was successfuly set & closed");  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

}
