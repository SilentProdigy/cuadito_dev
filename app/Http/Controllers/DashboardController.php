<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Order;
use Auth;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    public function show_users()
    {
        $users = User::all();
        $current_user = Auth::user();
        return view('user_listing', compact(['users', 'current_user']));
    }

    // PROFILE FUNCTIONS
    public function profile($id)
    {
        $user = User::find($id);

        return view('profile', compact('user'));
    }


    // END OF PROFILE FUNCTIONS

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('admin/admin-dashboard');
    }

    public function showOrders()
    {
        $orders = Order::paginate(10);

        foreach ($orders as $key => $order) {
            if ($order->customer_id) {
                $address = Address::where('customer_id', '=', $order->customer_id)->first();
            } else {
                $address = Address::where('user_id', '=', $order->user_id)->first();
            }
            $orders[$key]->address = $address;
        }

        $data = [
            'orders' => $orders,
        ];

        return view('admin/admin-orders', $data);
    }
}
