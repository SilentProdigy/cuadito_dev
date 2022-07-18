<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    
    use UploadFile;
    
    public function create(Project $project)
    {
        return view('client.proposals.create')->with(compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        try 
        {
            $proposal = $project->biddings()
            ->create(
                array_merge(
                    $request->only('rate', 'cover_letter'),
                    ['company_id' => session('config.company') ]
                )
            );
        
            foreach($request->file('attachments') as $attachment)
            {
                $target_dir = "projects/". $project->id ."/proposals/" . $proposal->id;
                $path = $this->uploadFile($target_dir, $attachment);
                $proposal->attachments()->create(['url' => $path]);
            }   
        
            return redirect(route('client.listing.index'))
                    ->with('success', 'Project was successfully created & posted.');
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }

    }
}
