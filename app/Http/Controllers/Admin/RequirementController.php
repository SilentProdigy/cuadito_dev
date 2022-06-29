<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::get();
        return view('admin.requirements.index')->with(compact('requirements'));   
    }

    public function delete()
    {

    }
}
