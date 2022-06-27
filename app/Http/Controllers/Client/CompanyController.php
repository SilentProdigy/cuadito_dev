<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Company\CreateCompanyFormRequest;
use App\Http\Requests\Client\Company\EditCompanyFormRequest;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = auth('client')->user()->companies;
        return view('client.companies.index')->with(compact('companies'));   
    }

    public function create()
    {
        return view('client.companies.create');   
    }

    public function edit(Company $company)
    {
        return view('client.companies.edit')->with(compact('company'));
    }

    public function store(CreateCompanyFormRequest $request)
    {
        try 
        {
            // Company::create($request->all());
            auth('client')->user()->companies()->create($request->all());
            return redirect()->route('client.companies.index')->with('success', 'Company was successfully created.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function update(EditCompanyFormRequest $request, Company $company)
    {
        try 
        {
            $company->update($request->all());
            return redirect()->route('client.companies.index')->with('success', 'Company was successfully updated.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function destroy(Company $company)
    {
        try
        {
            $company->delete();
            return redirect()->route('client.companies.index')->with('success', 'Company was successfully deleted.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
