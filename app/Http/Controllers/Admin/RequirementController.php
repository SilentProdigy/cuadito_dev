<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Exception;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::get();
        return view('admin.requirements.index')->with(compact('requirements'));   
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
