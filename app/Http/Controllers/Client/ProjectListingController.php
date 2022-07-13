<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectListingController extends Controller
{
    public function index()
    {
        return view('client.listing.index');
    }
}
