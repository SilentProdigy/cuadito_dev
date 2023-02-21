<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::query()
                    ->when(request('search'), function($query) {
                        $query->where('name', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('contact_number', 'LIKE', '%' . request('search') . '%');
                    })
                    ->with('client')
                    ->paginate(Company::ITEMS_PER_PAGE); 

        $company_states = Company::COMPANY_STATES;
        return view('admin.companies.index')->with(compact('companies', 'company_states'));
    }

    public function show(Company $company)
    {   
        $company_states = Company::COMPANY_STATES;
        return view('admin.companies.show')->with(compact('company', 'company_states'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        DB::beginTransaction();
        try
        {

            if($request->input('validation_status') == Company::APPROVED_STATUS) 
            {
                if($company->hasDisapprovedRequirements())
                {
                    return redirect()->back()->withErrors([
                        'message' => "Invalid Operation! Cannot approve the company because it doesn't meet the requirements"
                    ]);
                }

                if(!$company->have_complete_requirements)
                {
                    return redirect()->back()->withErrors([
                        'message' => "Invalid Operation! Cannot approve the company because it has incomplete requirements"
                    ]);
                }

                if(!$company->haveCompleteApprovedRequirements())
                {
                    return redirect()->back()->withErrors([
                        'message' => "Invalid Operation! Cannot approve the company because not all requirements are approved!"
                    ]);
                }
            }
            
            $company->update($request->all());

            if($company->validation_status === Company::DISAPPROVED_STATUS) {
                $company->client->notifications()->create([
                    'content' => "Your company {$company->name} was disapproved by the Admin.",
                    'url' => route('client.companies.show', $company), 
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Company status was successfully set!');  
        }
        catch(\Exception $e)
        {   
            Log::error("ACTION: ADMIN_UPDATE_COMPANY, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }
}
