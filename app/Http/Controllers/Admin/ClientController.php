<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        
        $clients = Client::query()
                    ->when(request('search'), function($query) {
                        $query->where('name', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('contact_number', 'LIKE', '%' . request('search') . '%');
                    })
                    ->withCount(['companies', 'projects', 'biddings'])
                    // ->paginate(Client::ITEMS_PER_PAGE);    
                    ->get();

        return view('admin.clients.index')->with(compact('clients'));
    }

    public function show(Client $client)
    {
        return view('admin.clients.show')->with(compact('client'));
    }
}
