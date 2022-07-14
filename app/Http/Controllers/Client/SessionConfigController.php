<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionConfigController extends Controller
{
    public function update(Request $request)
    {
        session(['config.company' => $request->input('company_id')]);

        return redirect()->back()->with('success', 'Company global config was successfully updated.');  
    }
}
