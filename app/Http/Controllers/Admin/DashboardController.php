<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $projects_count = Project::count();
        $clients_count = Client::count();
        $biddings_count = Bidding::count();
        $projects = Project::with('company')
                    ->where('status', Project::ACTIVE_STATUS)
                    ->orderBy('id', 'desc')
                    ->take(5)
                    ->get();

        $payment_total = Payment::get()->sum('total_amount');

        return view('admin.dashboard.index')->with(
            compact(
                'projects_count', 
                'clients_count', 
                'projects', 
                'biddings_count',
                'payment_total'
            )
        );
    }
}
