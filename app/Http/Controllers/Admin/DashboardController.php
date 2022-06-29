<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $projects_count = Project::count();
        $clients_count = Client::count();
        return view('admin.dashboard.index')->with(compact('projects_count', 'clients_count'));
    }
}
