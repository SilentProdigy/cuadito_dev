<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    public function store(Request $request)
    {
        try 
        {
            auth('client')->user()->contacts()->create($request->all());
            return redirect(route('client.contacts.index'))->with('success', 'Connection was successfully added!');
        }
        catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }   
    }
}
