<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Proposal\SubmitProposalRequest;
use App\Models\Attachment;
use App\Models\Bidding;
use App\Models\Project;
use App\Traits\CheckIfCompanyHasProposalToProject;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    
    use UploadFile, CheckIfCompanyHasProposalToProject;

    public function show(Bidding $bidding)
    {
        return view('client.proposals.show')->with(compact('bidding'));
    }
    
    public function create(Project $project)
    {
        if($this->checkIfCompanyHasProposalToProject($project))
        {
            return redirect()->back()->withErrors([
                'message' => 'You already submitted a proposal for this project!'
            ]);
        }

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
            
        
            return redirect(route('client.listing.index'))
                    ->with('success', 'Proposal was successfully posted.');
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }

    }
}
