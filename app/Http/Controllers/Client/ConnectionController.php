<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConnectionController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try 
        {
            auth('client')->user()->contacts()->create($request->all());
            DB::commit();
            return redirect(route('client.contacts.index'))->with('success', 'Connection was successfully added!');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            Log::error("ACTION: CREATE_CONNECTIOn, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }   
    }
}
