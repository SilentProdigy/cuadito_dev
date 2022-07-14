<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectListingController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', Project::ACTIVE_STATUS)
                    ->orderBy('id', 'desc')
                    ->paginate(5);

        $companies = auth('client')->user()->companies;                    
        return view('client.listing.index')->with(compact('projects', 'companies'));
    }

    public function show(Project $project)
    {
        return $project;
        // return view('client.listing.index')->with(compact('projects'));
    }
}
