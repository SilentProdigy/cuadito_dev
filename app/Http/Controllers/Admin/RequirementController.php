<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Requirement\CreateRequirementRequest;
use App\Http\Requests\Admin\Requirement\UpdateRequirementRequest;
use App\Models\Requirement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RequirementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role.ensure_is_admin');
    }

    public function index()
    {
        $requirements = Requirement::paginate(Requirement::ITEMS_PER_PAGE);
        return view('admin.requirements.index')->with(compact('requirements'));   
    }

    public function store(CreateRequirementRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $data = $request->only('name');

            $data['required'] = $request->input('required') == 'true' ? true : false;

            Requirement::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Requirement was successfully created!');  
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: ADMIN_CREATE_REQUREMENT, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function update(UpdateRequirementRequest $request, Requirement $requirement)
    {
        DB::beginTransaction();
        try
        {
            $data = $request->only('name');

            $data['required'] = $request->input('required') == 'true' ? true : false;

            $requirement->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Requirement was successfully updated!');  
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: ADMIN_UPDATE_REQUREMENT, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function destroy(Requirement $requirement)
    {
        DB::beginTransaction();
        try 
        {
            $requirement->delete();
            DB::commit();
            return redirect()->route('admin.requirements.index')->with('success', 'Requirement was successfully deleted.');  
        }
        catch(\Exception $e) 
        {
            Log::error("ACTION: ADMIN_DESTROY_REQUREMENT, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }
}
