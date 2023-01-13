<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Project\CreateProjectRequest;
use App\Http\Requests\Client\Project\SetProjectWinnerRequest;
use App\Http\Requests\Client\Project\UpdateProjectRequest;
use App\Http\Requests\Client\Project\UpdateProjectStatusRequest;
use App\Jobs\CreateProjectClosedNotifications;
use App\Mail\Project\ProjectClosed;
use App\Mail\Project\ProposalApproved;
use App\Mail\Project\ProposalDisapproved;
use App\Models\Bidding;
use App\Models\Company;
use App\Models\Project;
use App\Services\CompanyService;
use App\Services\ProjectService;
use App\Traits\DecreaseProjectCountOnSubscription;
use App\Traits\IncreaseProjectCountOnSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{   
    use IncreaseProjectCountOnSubscription, DecreaseProjectCountOnSubscription;

    private $companyService;
    private $projectService;

    public function __construct(CompanyService $companyService, ProjectService $projectService)
    {
        $this->companyService = $companyService;
        $this->projectService = $projectService;

        $this->middleware('client.projects.ensure_client_projects_dit_not_reach_max_projects')
            ->only(['create', 'store']);
    }

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
        $companies = $this->companyService->getApprovedCompaniesOfClient();
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
        DB::beginTransaction();

        try 
        {            
            $project_details = $request->except(['company_id', 'categories_ids']);
            $category_ids = $request->input('category_ids');
            $company = Company::find($request->input('company_id'));
            $project = $this->companyService->createProject($company, $project_details, $category_ids);
            $this->increaseProjectCountOnSubscription(
                auth('client')->user()->active_subscription
            );

            DB::commit();
            return redirect(route('client.projects.index'))->with('success', 'Project was successfully created & posted.');  
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            
            return redirect()->back()->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
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
        // $proposals = Bidding::where('project_id', $project->id);
        $proposals = $project->proposals();
        
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
        $companies = $this->companyService->getApprovedCompaniesOfClient();

        $selected_category_ids = $project->categories->pluck('id')->toArray();
        
        return view('client.projects.edit')->with(compact('project', 'companies', 'selected_category_ids'));
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
        DB::beginTransaction();
        try 
        {
            // TODO: Additional business logic here
            $project_details = $request->except(['company_id', 'category_ids']);
            $category_ids = $request->input('category_ids');
            $this->projectService->updateProject($project, $project_details, $category_ids);

            DB::commit();
            return redirect(route('client.projects.index'))->with('success', 'Project was successfully updated.');  
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            
            return redirect()->back()->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
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
            $project->delete();
            // $this->dec`  reaseProjectCountOnSubscription(auth('client')->user()->active_subscription);
            return redirect(route('client.projects.index'))->with('success', 'Project was successfully deleted.');  
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
        }
    }

    public function setStatus(UpdateProjectStatusRequest $request, Project $project)
    {
        try 
        {
            $project->update($request->validated());
            return redirect(route('client.projects.index'))->with('success', 'Project status was successfully set.');  
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
        }
    }

    public function setWinner(SetProjectWinnerRequest $request, Project $project)
    {
        try 
        {   
            DB::beginTransaction();            
            $this->projectService->setWinner($project, $request->validated());
            
            $project_owner = auth('client')->user();
            
            $winning_proposal_owner = Bidding::getOwner($request->input('winner_bidding_id'));

            if(!$winning_proposal_owner || !$project_owner)
            {
                return redirect()->back()->withErrors(['message' => "Invalid Operation: Missing required data for ownership!"]);
            }

            // add the invitor as default contact or connection
            $project_owner->contacts()->create([
                'contact_id' => $winning_proposal_owner->id
            ]);

            $winning_proposal_owner->contacts()->create([
                'contact_id' => $project_owner->id
            ]);

            DB::commit();
            return redirect(route('client.projects.index'))->with('success', "Project's winner was successfuly set & closed");  
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
        }
    }

    public function proposals(Project $project) 
    {
        if(!$project->is_owned && !$project->is_winner)
        {
            return redirect(route('client.proposals.index'))->withErrors(['message' => 'Unauthorized Access!']);
        }

        $proposals = $project->proposals();        
        
        if(request('search'))
        {
            $proposals->where('rate', 'LIKE', '%' . request('search') . '%')            
            ->orWhereHas('company', function($query) {
                $query->where('name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('email', 'LIKE', '%' . request('search') . '%');
            });
        }

        if(request('min_rate') && request('max_rate'))
        {
            $proposals->whereBetween('rate', [ request('min_rate'), request('max_rate') ]);
        }

        if(request('min_date') && request('max_date'))
        {
            $proposals->whereBetween('created_at', [ request('min_date'), request('max_date') ]);
        }

        $proposals = $proposals->paginate(10);
        
        return view('client.projects.proposals')->with(compact('proposals', 'project'));
    }
}
