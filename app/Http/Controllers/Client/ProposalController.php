<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function create(Project $project)
    {
        return view('client.proposals.create')->with(compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        return $request->all();
    }
}
