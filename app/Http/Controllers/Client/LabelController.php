<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Label;
use Exception;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = auth('client')->user()->labels;

        return view('client.labels.index')->with(compact('labels'));
    }
 
    public function store(Request $request)
    {
        try 
        {
            // Label::create($request->all());
            auth('client')->user()->labels()->create($request->all());
            return redirect()->back()->with('success', 'Label was successfully created.');     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function update(Label $label,Request $request)
    {
        try 
        {
            // Label::create($request->all());
            // auth('client')->user()->labels()->create($request->all());
            $label->update($request->all());
            return redirect()->back()->with('success', 'Label was successfully updated.');     
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
