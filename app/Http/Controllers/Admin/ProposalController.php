<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function show(Bidding $bidding)
    {
        return view('admin.proposals.show')->with(compact('bidding'));
    }
}
