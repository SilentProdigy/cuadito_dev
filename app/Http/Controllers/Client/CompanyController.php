<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Company\CreateCompanyFormRequest;
use App\Http\Requests\Client\Company\EditCompanyFormRequest;
use App\Models\Company;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\LaravelXssProtection\Middleware\XssCleanInput;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('client.validate.companies.max_count')->only(['create', 'store']);
        $this->middleware(XssCleanInput::class)->only(['store', 'update']);
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
        if (!$company->checkIfUserOwned()) {
            return redirect(route('client.companies.index'))->withErrors(['message' => 'Unauthorized Access!']);
        }

        return view('client.companies.edit')->with(compact('company'));
    }

    public function store(CreateCompanyFormRequest $request)
    {
        DB::beginTransaction();
        try 
        {
            // Company::create($request->all());
            auth('client')->user()->companies()->create($request->validated());
            DB::commit();
            return redirect(route('client.companies.index'))
                ->with('success', 'Company was successfully created.');
        } 
        catch (\Exception $e) {
            Log::error("ACTION: STORE_COMPANY, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function update(EditCompanyFormRequest $request, Company $company)
    {
        DB::beginTransaction();
        try {
            $company->update($request->validated());
            DB::commit();
            return redirect(route('client.companies.index'))
                ->with('success', 'Company was successfully updated.');
        } catch (\Exception $e) {
            Log::error("ACTION: UPDATE_COMPANY, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function destroy(Company $company)
    {
        DB::beginTransaction();
        try {
            if (!$company->checkIfUserOwned()) {
                return redirect(route('client.companies.index'))->withErrors(['message' => 'Unauthorized Access!']);
            }

            $company->delete();
            DB::commit();
            return redirect(route('client.companies.index'))->with('success', 'Company was successfully deleted.');
        } catch (\Exception $e) {
            Log::error("ACTION: DESTROY_COMPANY, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }
}
