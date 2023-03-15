<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Proposal\SubmitProposalRequest;
use App\Mail\Project\ProposalSubmitted;
use App\Models\Attachment;
use App\Models\Bidding;
use App\Models\Company;
use App\Models\Notification;
use App\Models\Project;
use App\Services\CompanyService;
use App\Services\ProposalService;
use App\Traits\CheckIfClientOwnedAProject;
use App\Traits\CheckIfCompanyHasProposalToProject;
use App\Traits\SendEmail;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\LaravelXssProtection\Middleware\XssCleanInput;

class ProposalController extends Controller
{

    use UploadFile;
    use SendEmail;

    private $companyService;
    private $proposalService;

    public function __construct(CompanyService $companyService, ProposalService $proposalService)
    {
        $this->companyService = $companyService;
        $this->proposalService = $proposalService;

        $this->middleware(['client.validate.ensure_project_not_owned_by_client'])->only(['create', 'store']);
        $this->middleware(XssCleanInput::class)->only('store');
    }

    public function index()
    {
        $client_companies = $this->companyService->getClientApprovedCompaniesIds();

        $proposals = Bidding::with('project')->whereIn('company_id', $client_companies);

        if (request('search')) {
            $proposals
                ->where(function ($query) {
                    $query->where('rate', 'LIKE', '%' . request('search') . '%')
                        ->orWhereDate('created_at', 'LIKE', '%' . request('search') . '%'); // TODO: Make this format to M d,Y
                })
                ->orWhereHas('company', function ($query) {
                    $query->where('name', 'LIKE', '%' . request('search') . '%');
                })
                ->orWhereHas('project', function ($query) {
                    $query->where('title', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('status', 'LIKE', '%' . request('search') . '%');
                });
        }

        // $proposals = $proposals->paginate(10);
        $proposals = $proposals->get();

        return view('client.proposals.index')->with(compact('proposals'));
    }

    public function show(Bidding $bidding)
    {
        $bidding->load('requirements');

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
            $proposal = $this->proposalService->createProposal(
                $project,
                array_merge(
                    $request->only('rate', 'cover_letter'),
                    ['company_id' => session('config.company')]
                )
            );

            foreach($project->requirements as $requirement)
            {
                $file = $request->file("requirements_{$requirement->id}");
                $target_dir = "projects/". $project->id ."/proposals";
                
                // Attaching files to proposal
                $path = $this->uploadFile($target_dir,$file);
                $proposal->requirements()->create([
                    'url' => $path,
                    'project_requirement_id' => $requirement->id
                ]);
            }
                
            Bidding::createNotificationsForProposal($proposal);

            $this->sendEmail([$project->company->email], new ProposalSubmitted($proposal));

            DB::commit();
            return redirect(route('client.payments.proposal.create', $proposal))
                    ->with('success', 'Proposal was successfully created. You may now pay us the fee first for it to be posted.');
                    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ACTION: CREATE_PROPOSAL, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }

    public function cancel(Bidding $bidding)
    {
        try {
            DB::beginTransaction();

            if (!$bidding->is_owned) {
                return redirect(route('client.proposals.index'))->withErrors(['message' => 'Unauthorized Access!']);
            }

            if ($bidding->project->status !== Project::ACTIVE_STATUS) {
                return redirect()->back()->withErrors(['message' => "Invalid Operation: Cannot cancel proposal since the project was not active."]);
            }

            Bidding::cancelProposal($bidding);

            // $this->decreaseProposalCountOnSubscription($active_subscrption);
            DB::commit();
            return redirect(route('client.proposals.index'))->with('success', 'Proposal was successfully cancelled.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ACTION: CANCEL_PROPOSAL, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }
}
