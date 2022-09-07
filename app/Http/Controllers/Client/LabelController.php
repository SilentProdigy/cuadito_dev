<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Label;
use Exception;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function store(Request $request)
    {
        try 
        {
            // Label::create($request->all());
            auth('client')->user()->labels()->create($request->all());
            return redirect()->back()->with('success', 'Message was successfully sent.');     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
