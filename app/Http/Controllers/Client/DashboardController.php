<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $data = [
            'projects_count' => auth('client')->user()->projects()->count(),
            'companies_count' => auth('client')->user()->companies()->count(),
            'biddings_count' => auth('client')->user()->biddings()->count(),
            'projects' => auth('client')->user()->projects,
        ];
        return view('client.dashboard.index')->with(compact('data'));
    }
}
