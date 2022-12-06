<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionType\CreateSubscriptionTypeRequest;
use App\Http\Requests\Admin\SubscriptionType\UpdateSubscriptionTypeRequest;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionTypeController extends Controller
{
    public function index()
    {
        $subscription_types = SubscriptionType::withCount('active_subscriptions')->paginate(10);
        return view('admin.subcription_types.index')->with(compact('subscription_types'));
    }

    public function store(CreateSubscriptionTypeRequest $request)
    {
        try
        {
            SubscriptionType::create($request->all());
            return redirect()->back()->with('success', 'Product was successfully added.');  
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function update(SubscriptionType $subscriptionType, UpdateSubscriptionTypeRequest $request)
    {
        try
        {
            $subscriptionType->update($request->all());
            return redirect()->back()->with('success', 'Product was successfully updated.');  
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function destroy(SubscriptionType $subscriptionType)
    {
        try
        {
            $subscriptionType->delete();
            return redirect()->back()->with('success', 'Product was successfully deleted.');  
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
