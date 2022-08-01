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

            $data = $request->all();

            if($data['status'] == CompanyRequirement::APPROVED_STATUS) 
                $data['remarks'] = "";

            $company_requirement->update($data);

            return redirect()->back()->with('success', "Success in updating the status of the Client's requirement!");
        }
        catch(Exception $e)
        {   
            dd($e->getMessage());
        }
    }

    public function download(Company $company, Requirement $requirement)
    {
        $target_file = $company->requirements->where('id', $requirement->id)->first();

        return Storage::disk('public')->download($target_file->file->url);
    }   
}
