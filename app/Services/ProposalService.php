<?php 

namespace App\Services;

use App\Models\Attachment;
use App\Models\Company;
use App\Models\Project;
use App\Traits\UploadFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
            $target_dir = "projects/". $project->id ."/proposals";
            $file_paths->push($this->uploadFile($target_dir, $attachment));
        }   

        return $file_paths;
    }
}
