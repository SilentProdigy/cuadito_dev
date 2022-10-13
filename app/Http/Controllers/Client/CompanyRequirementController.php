<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Company\UploadRequirementRequest;
use App\Models\Company;
use App\Models\Requirement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadFile;

class CompanyRequirementController extends Controller
{
    use UploadFile;

    public function store(UploadRequirementRequest $request, Company $company)
    {
        try 
        {
            $target_dir = 'companies/requirements/' . $company->id;
            $path = $this->uploadFile($target_dir, $request->file('requirement'));
            
            $company->requirements()->attach(
                $request->input('requirement_id'),
                ['url' => $path]
            );

            return redirect()->back()->with('success', 'Requirement was successfully uploaded.');     
        }
        catch(\Exception $e)
        {
            return redirect(route('client.companies.show', $company))->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
        }
    }


    private function deleteFile($url)
    {
        try 
        {   
            if( Storage::disk('public')->exists($url) )
            {
                Storage::disk('public')->delete($url);
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function download(Company $company, Requirement $requirement)
    {
        try 
        {
            $target_file = $company->requirements->where('id', $requirement->id)->firstOrFail();

            return Storage::disk('public')->download($target_file->file->url);
        }
        catch(\Illuminate\Support\ItemNotFoundException $e)
        {
            return redirect(route('client.companies.show', $company))->withErrors([
                "Company requirement not found!"
            ]);
        }
        catch(\Exception $e)
        {
            return redirect(route('client.companies.show', $company))
                    ->withErrors([
                        'Operation Failed!' => $e->getMessage()
                    ]);
        }
    }   

    public function destroy(Request $request, Company $company, Requirement $requirement)
    {    
        $old_file = $company->requirements->where('id', $requirement->id)->first();

        $this->deleteFile($old_file->file->url);

        $company->requirements()->detach($requirement->id);

        return redirect()->back()->with('success', 'Requirement was successfully deleted.');  
    }

}
