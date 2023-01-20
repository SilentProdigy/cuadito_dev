<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Company\CreateCompanyFormRequest;
use App\Http\Requests\Client\Company\EditCompanyFormRequest;
use App\Models\Company;
use App\Models\Requirement;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('client.validate.companies.max_count')->only(['create', 'store']);
    }

    public function index()
    {
        $companies = auth('client')->user()->companies;
        return view('client.companies.index')->with(compact('companies'));   
    }


    public function show(Company $company)
    {  
        $client_submitted_requirements = $company->requirements->pluck('id')->toArray();
        $missing_requirements = Requirement::whereNotIn('id', $client_submitted_requirements)->get();
        $featured_projects = $company->projects()->orderBy('id', 'desc')->take(5)->get();        
        return view('client.companies.show')->with(compact('company', 'client_submitted_requirements', 'missing_requirements', 'featured_projects'));
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
            auth('client')->user()->companies()->create($request->validated());

            return redirect(route('client.companies.index'))
                ->with('success', 'Company was successfully created.');  
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
        }
    }

    public function update(EditCompanyFormRequest $request, Company $company)
    {
        try 
        {
            $company->update($request->except('name'));
            return redirect(route('client.companies.index'))
                    ->with('success', 'Company was successfully updated.');  
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Company $company)
    {
        try
        {
            $company->delete();
            return redirect(route('client.companies.index'))
            ->with('success', 'Company was successfully deleted.');  
        }
        catch(\Exception $e)
        {
            return redirect(route('client.companies.index'))->withErrors([
                'Operation Failed!' => $e->getMessage()
            ]);
        }
    }
}
