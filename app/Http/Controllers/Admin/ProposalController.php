<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Bidding::with('project');
        if (request('search')) {
            $proposals
                ->where(function ($query) {
                    $query->where('rate', 'LIKE', '%' . request('search') . '%')
                        ->orWhereDate('created_at', 'LIKE', '%' . request('search') . '%'); // TODO: Make this format to M d,Y
                })
                ->orWhereHas('company', function ($query) {
                    $query->where('name', 'LIKE', '%' . request('search') . '%');
                })
                ->orWhereHas('project', function ($query) {
                    $query->where('title', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('status', 'LIKE', '%' . request('search') . '%');
                });
        }

        $proposals = $proposals->paginate(10);

        return view('admin.proposals.index')->with(compact('proposals'));
    }

    public function show(Bidding $bidding)
    {
        return view('admin.proposals.show')->with(compact('bidding'));
    }
}
