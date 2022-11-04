<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionTypeController extends Controller
{
    public function index()
    {
        $subscription_types = SubscriptionType::paginate(10);

        return view('admin.subcription_types.index')->with(compact('subscription_types'));
    }
}
