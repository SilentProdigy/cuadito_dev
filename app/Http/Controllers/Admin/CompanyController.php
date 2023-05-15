<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class CompanyController extends Controller
{
    public function index()
    {
        function company_query()
        {
            $query = Company::query()
                ->when(request("search"), function ($query) {
                    $query
                        ->where("name", "LIKE", "%" . request("search") . "%")
                        ->orWhere(
                            "email",
                            "LIKE",
                            "%" . request("search") . "%"
                        )
                        ->orWhere(
                            "contact_number",
                            "LIKE",
                            "%" . request("search") . "%"
                        );
                })
                ->with("client");

            return $query;
        }

        $tab = request()->tab;

        // if($tab === Company::FOR_APPROVAL_STATUS)
        //     $companies->where("validation_status",  $tab);
        // else if($tab === Company::APPROVED_STATUS)
        //     $companies->where("validation_status",  $tab);
        // else if($tab === Company::DISAPPROVED_STATUS)
        //     $companies->where("validation_status",  $tab);

        $companies = company_query()->paginate(Company::ITEMS_PER_PAGE);

        // return $companies;

        $approved = company_query()
            ->where("validation_status", Company::APPROVED_STATUS)
            ->paginate(Company::ITEMS_PER_PAGE)
            ->appends(["tab" => Company::APPROVED_STATUS]);

        $pending = company_query()
            ->where("validation_status", Company::FOR_APPROVAL_STATUS)
            ->paginate(Company::ITEMS_PER_PAGE)
            ->appends(["tab" => Company::FOR_APPROVAL_STATUS]);

        $disapproved = company_query()
            ->where("validation_status", Company::DISAPPROVED_STATUS)
            ->paginate(Company::ITEMS_PER_PAGE)
            ->appends(["tab" => Company::DISAPPROVED_STATUS]);

        $perPage = \App\Models\Company::ITEMS_PER_PAGE;
        $page = request("page", 1);
        $totalEntries = $companies->total();
        $firstEntry = ($page - 1) * $perPage + 1;
        $lastEntry = min($firstEntry + $perPage - 1, $totalEntries);

        // return compact(["totalEntries", "firstEntry", "lastEntry"]);

        // return $companies;

        // return compact(['approved', 'pending', 'disapproved']);

        // return $companies->get();

        $company_states = Company::COMPANY_STATES;

        // return $company_states;
        return view("admin.companies.index")->with(
            compact(
                "companies",
                "company_states",
                "approved",
                "pending",
                "disapproved",
                "tab"
            )
        );
        // return view('admin.companies.index2')->with(compact('companies', 'company_states', 'tab'));
    }

    public function show(Company $company)
    {
        $company_states = Company::COMPANY_STATES;
        return view("admin.companies.show")->with(
            compact("company", "company_states")
        );
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        DB::beginTransaction();
        try {
            if (
                $request->input("validation_status") == Company::APPROVED_STATUS
            ) {
                if ($company->hasDisapprovedRequirements()) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            "message" =>
                                "Invalid Operation! Cannot approve the company because it doesn't meet the requirements",
                        ]);
                }

                if (!$company->have_complete_requirements) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            "message" =>
                                "Invalid Operation! Cannot approve the company because it has incomplete requirements",
                        ]);
                }

                if (!$company->haveCompleteApprovedRequirements()) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            "message" =>
                                "Invalid Operation! Cannot approve the company because not all requirements are approved!",
                        ]);
                }
            }

            $company->update($request->all());

            if ($company->validation_status === Company::DISAPPROVED_STATUS) {
                $company->client->notifications()->create([
                    "content" => "Your company {$company->name} was disapproved by the Admin.",
                    "url" => route("client.companies.show", $company),
                ]);
            }

            DB::commit();
            return redirect()
                ->back()
                ->with("success", "Company status was successfully set!");
        } catch (\Exception $e) {
            // dd($e);

            Log::error(
                "ACTION: ADMIN_UPDATE_COMPANY, ERROR:" . $e->getMessage()
            );
            DB::rollBack();
            return redirect()
                ->back()
                ->withErrors([
                    "Operation Failed!" =>
                        "Something went wrong; We are working on it.",
                ]);
        }
    }
}
