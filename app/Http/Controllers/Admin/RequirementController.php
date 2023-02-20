<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Requirement\CreateRequirementRequest;
use App\Http\Requests\Admin\Requirement\UpdateRequirementRequest;
use App\Models\Requirement;
use Exception;
use Illuminate\Http\Request;

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
        try
        {
            $data = $request->only('name');

            $data['required'] = $request->input('required') == 'true' ? true : false;

            Requirement::create($data);
            return redirect()->back()->with('success', 'Requirement was successfully created!');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function update(UpdateRequirementRequest $request, Requirement $requirement)
    {
        try
        {
            $data = $request->only('name');

            $data['required'] = $request->input('required') == 'true' ? true : false;

            $requirement->update($data);
            return redirect()->back()->with('success', 'Requirement was successfully updated!');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function destroy(Requirement $requirement)
    {
        try 
        {
            $requirement->delete();
            return redirect()->route('admin.requirements.index')->with('success', 'Requirement was successfully deleted.');  
        }
        catch(Exception $e) {
            dd($e->getMessage());
        }
    }
}
