<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyRequirement;
use App\Models\Requirement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyRequirementController extends Controller
{
    public function store(Request $request, Company $company)
    {
        $target_dir = 'companies/requirements/' . $company->id;
        $path = $this->createFile($target_dir, $request->file('requirement'));
        
        $company->requirements()->attach(
            $request->input('requirement_id'),
            ['url' => $path]
        );

        return redirect()->back()->with('success', 'Requirement was successfully uploaded.');     
    }

    private function createFile($target_dir, UploadedFile $file)
    {   
        try
        {
            // Storing a new file
            $path = Storage::disk('public')->put($target_dir, $file);

            return $path;
        }
        catch(Exception $e)
        {
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return;
    }

    private function deleteFile($url)
    {
        if( Storage::disk('public')->exists($url) )
        {
            try 
            {
                Storage::disk('public')->delete($url);
            }
            catch(Exception $e)
            {
                return redirect()->back()->with('errors', $e->getMessage());
            }
        }

        return;
    }

    public function download(Company $company, Requirement $requirement)
    {
        $target_file = $company->requirements->where('id', $requirement->id)->first();

        return Storage::disk('public')->download($target_file->file->url);
    }   

    public function destroy(Request $request, Company $company, Requirement $requirement)
    {    
        $old_file = $company->requirements->where('id', $requirement->id)->first();

        $this->deleteFile($old_file->file->url);

        $company->requirements()->detach($requirement->id);

        return redirect()->back()->with('success', 'Requirement was successfully deleted.');  
    }

}
