<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('client')->get();
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
        try
        {
            $company->update($request->all());

            if($company->validation_status === Company::DISAPPROVED_STATUS) {
                $company->client->notifications()->create([
                    'content' => "Your company {$company->name} was disapproved by the Admin.",
                    'url' => route('client.companies.show', $company), 
                ]);
            }

            return redirect()->back()->with('success', 'Company status was successfully set!');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
