<?php 

namespace App\Services;

use App\Models\Attachment;
use App\Models\Company;
use App\Models\Project;
use App\Traits\UploadFile;

class ProposalService
{
    use UploadFile;

    public function createProposal(Project $project, $data)
    {
        return $project->biddings()->create($data);
    }

    public function uploadProposalAttachments(Project $project, $attachments)
    {
        $file_paths = collect();

        foreach($attachments as $attachment)
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
            $file_paths->push($this->uploadFile($target_dir, $attachment));
        }   

        return $file_paths;
    }
}
