<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionType\CreateSubscriptionTypeRequest;
use App\Http\Requests\Admin\SubscriptionType\UpdateSubscriptionTypeRequest;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscriptionTypeController extends Controller
{
    public function index()
    {
        $subscription_types = SubscriptionType::withCount('active_subscriptions')->paginate(10);
        return view('admin.subcription_types.index')->with(compact('subscription_types'));
    }

    public function store(CreateSubscriptionTypeRequest $request)
    {
        DB::beginTransaction();
        try
        {
            SubscriptionType::create($request->all());
            DB::commit();
            return redirect()->back()->with('success', 'Product was successfully added.');  
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: ADMIN_CREATE_PRODUCT, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function update(SubscriptionType $subscriptionType, UpdateSubscriptionTypeRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $subscriptionType->update($request->all());
            DB::commit();
            return redirect()->back()->with('success', 'Product was successfully updated.');  
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: ADMIN_UPDATE_PRODUCT, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function destroy(SubscriptionType $subscriptionType)
    {
        DB::beginTransaction();
        try
        {
            $subscriptionType->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Product was successfully deleted.');  
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: ADMIN_DESTROY_PRODUCT, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }
}
