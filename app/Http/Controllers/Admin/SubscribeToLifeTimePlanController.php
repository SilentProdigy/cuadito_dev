<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Traits\ActivateLifeTimeSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscribeToLifeTimePlanController extends Controller
{
    use ActivateLifeTimeSubscription;

    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $client = Client::findOrFail($request->input('client_id'));
            
            if(!$client->have_subscription)
            {
                return redirect()->back()->withErrors(['message' => "Error! Cannot avail life-time plan promo since Client don't have active subscription!"]);
            }
            
            $this->activateLifeTimeSubscription($client->active_subscription);

            DB::commit();
            return redirect()->back()->with('success', 'Success in activating the life-time plan for Client #' . $client->id);
        }        
        catch(\Exception $e)
        {
            DB::rollBack();
            Log::error("ERROR_OCCURED:". json_encode($e));
            return redirect()->back()->withErrors(['message' => 'Something went wrong!']);
        }
    }
}
