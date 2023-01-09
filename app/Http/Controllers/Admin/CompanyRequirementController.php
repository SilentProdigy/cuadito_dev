<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyRequirement;
use App\Models\Requirement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyRequirementController extends Controller
{

    public function update(Request $request, $id)
    {
        try 
        {
            $company_requirement = CompanyRequirement::findOrFail($id);

            $company = $company_requirement->company;

            $data = $request->all();

            if($data['status'] == CompanyRequirement::APPROVED_STATUS) 
                $data['remarks'] = "";

            $company_requirement->update($data);

            $have_unapproved_requirements = $company->requirements->where('file.status', '!=', CompanyRequirement::APPROVED_STATUS)->count() > 0;

            if(!$have_unapproved_requirements) {
                
                $company->update(['validation_status' => Company::APPROVED_STATUS]);
                return redirect()->back()->with('success', "Success in approving Company's application!");
            }
            
            return redirect()->back()->with('success', "Success in updating the status of the Client's requirement!");
        }
        catch(Exception $e)
        {   
            // dd($e->getMessage());
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function download(Company $company, Requirement $requirement)
    {
        $target_file = $company->requirements->where('id', $requirement->id)->first();

        return Storage::disk('public')->download($target_file->file->url);
    }   
}
