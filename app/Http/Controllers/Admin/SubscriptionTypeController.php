<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionType\CreateSubscriptionTypeRequest;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionTypeController extends Controller
{
    public function index()
    {
        $subscription_types = SubscriptionType::paginate(10);

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
}
