<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = SubscriptionType::get();
        $latest_subscription = auth('client')->user()->active_subscription;

        return view('client.products.index')->with(compact('products', 'latest_subscription'));
    }
}
