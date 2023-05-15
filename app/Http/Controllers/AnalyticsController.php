<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        return view("admin.analytics.index");

        $payments = Payment::all();
        $projects = Project::all();

        return $projects;
        return $payments;
    }
}
