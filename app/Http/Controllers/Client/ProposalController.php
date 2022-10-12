<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Proposal\SubmitProposalRequest;
use App\Models\Attachment;
use App\Models\Bidding;
use App\Models\Company;
use App\Models\Notification;
use App\Models\Project;
use App\Services\CompanyService;
use App\Services\ProposalService;
use App\Traits\CheckIfClientOwnedAProject;
use App\Traits\CheckIfCompanyHasProposalToProject;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    
    use UploadFile;

    private $companyService;
    private $proposalService;

    public function __construct(CompanyService $companyService, ProposalService $proposalService)
    {
        $this->companyService = $companyService;
        $this->proposalService = $proposalService;

        $this->middleware(['client.validate.ensure_project_not_owned_by_client'])
        ->only(['create']);
    }

    public function index()
    {
        $client_companies = $this->companyService->getClientApprovedCompaniesIds();
                           
        $proposals = Bidding::with('project')->whereIn('company_id',$client_companies );
        
        if(request('search'))
        {
            $proposals
            ->where(function($query) {
                $query->where('rate', 'LIKE', '%' . request('search') . '%')
                ->orWhereDate('created_at', 'LIKE', '%' . request('search') . '%'); // TODO: Make this format to M d,Y
            })
            ->orWhereHas('company', function($query) {
                $query->where('name', 'LIKE', '%' . request('search') . '%');
            })
            ->orWhereHas('project', function($query) {
                $query->where('title', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('status', 'LIKE', '%' . request('search') . '%');
            });
        }

        $proposals = $proposals->paginate(10);

        return view('client.proposals.index')->with(compact('proposals'));
    }

    public function show(Bidding $bidding)
    {
        return view('client.proposals.show')->with(compact('bidding'));
    }
    
    public function create(Project $project)
    {
        return view('client.proposals.create')->with(compact('project'));
    }

    public function store(SubmitProposalRequest $request, Project $project)
    {
        DB::beginTransaction();

        try 
        {
            $paths = collect();

            if($request->has('attachments')) 
            {
                $paths = $this->proposalService->uploadProposalAttachments(
                    $project,
                    $request->file('attachments')
                );
            }

            $proposal = $this->proposalService->createProposal($project, 
                array_merge(
                    $request->only('rate', 'cover_letter'),
                    ['company_id' => session('config.company') ]
                )
            );

            // Attaching files to proposal
            foreach($paths as $path)
                $proposal->attachments()->create(['url' => $path]);
 
            $proposing_company = Company::find(session('config.company'));

            $proposal->company->client->notifications()->create([
                'content' => "You submitted a proposal for Project: " . $project->title . " #" . $project->id,
                'url' => route('client.proposals.show', $proposal),
            ]);
            
            $project->owner->notifications()->create([
                'content' => $proposing_company->name . " submitted a proposal for your Project: " . $project->title . " #" . $project->id,
                'url' => route('client.projects.show', $project),
            ]);

            DB::commit();

            return redirect(route('client.listing.index'))
                    ->with('success', 'Proposal was successfully posted.');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
        }

    }
}
