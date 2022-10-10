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
use App\Traits\CheckIfClientOwnedAProject;
use App\Traits\CheckIfCompanyHasProposalToProject;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    
    use UploadFile;

    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;

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
        // dd($request->has('attachments'));

        try 
        {
            $paths = collect();

            if($request->has('attachments')) 
            {
                foreach($request->file('attachments') as $attachment)
                {   
                
                    $extension = $attachment->getClientOriginalExtension();
                    
                    if(!in_array($extension,Attachment::ALLOWED_FILE_TYPES))
                    {
                        return redirect()->back()
                                ->withErrors(['attachments' => 'Unsupported file type!', 
                                    'message' => "Please upload .jpg, .png, .jpeg or .pdf file types"
                                ]);
                    }

                   if($attachment->getSize() > Attachment::MAX_FILE_SIZE)
                   {
                        return redirect()->back()
                        ->withErrors(['attachments' => 'Reached max size!', 
                            'message' => "Please upload files that are less than or equal to 1 MB."
                        ]);
                   }
                    
                    $target_dir = "projects/". $project->id ."/proposals";
                    $paths->push($this->uploadFile($target_dir, $attachment));
                }   
            }

            $proposal = $project->biddings()
            ->create(
                array_merge(
                    $request->only('rate', 'cover_letter'),
                    ['company_id' => session('config.company') ]
                )
            );

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

            return redirect(route('client.listing.index'))
                    ->with('success', 'Proposal was successfully posted.');
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }

    }
}
