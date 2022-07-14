<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectListingController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', Project::ACTIVE_STATUS)->orderBy('id', 'desc')->get();
        return view('client.listing.index')->with(compact('projects'));
    }

    public function show(Project $project)
    {
        return $project;
        // return view('client.listing.index')->with(compact('projects'));
    }
}
