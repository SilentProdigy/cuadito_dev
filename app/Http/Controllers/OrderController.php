<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Address;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myOrders()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', '=', $user->id)->orderBy('id', 'desc')->paginate(10);

        foreach ($orders as $order) {
            if ($order->customer_id) {
                $customer = Customer::find($order->customer_id);
                $order->name = $customer->name;
                continue;
            }

            $user = User::find($order->user_id);
            $order->name = $user->name;
        }

        $data = [
            'orders' => $orders,
        ];

        return view('my_orders', $data);
    }

    public function invoice(Request $request)
    {
        $user = auth()->user();
        $orderId = $request->input('order_id');

        $order = Order::find($orderId);

        if ($order->user_id != $user->id) {
            throw new \Exception("You don't have permission to see this invoice");
        }

        $orderItems = OrderItem::leftJoin('products', function ($join) {
            $join->on('order_items.product_id', '=', 'products.id');
        })->where('order_items.order_id', '=', $order->id)
            ->get([
                'order_items.id',
                'order_items.product_id',
                'order_items.quantity',
                'order_items.total_item_amount',
                'products.name',
                'products.picture',
                'products.price',
                'products.unit',
            ]);

        $blanceDueAmount = Order::where('user_id', '=', $user->id)
            ->where('status', '=', 'UNPAID')
            ->sum('total_amount');

        if ($order->customer_id) {
            $address = Address::where('customer_id', '=', $order->customer_id)->first();
        } else {
            $address = Address::where('user_id', '=', $user->id)->first();
        }

        $data = [
            'balanceDueAmount' => $blanceDueAmount,
            'order' => $order,
            'orderItems' => $orderItems,
            'user' => $user,
            'address' => $address,
        ];

        return view('invoice', $data);
    }

    public function searchCustomer(Request $request)
    {
        $keyword = $request->input('keyword');
        if ($keyword) {
            $customer = Customer::where('name', 'LIKE', "$keyword%")->first();
            if ($customer) {
                $address = Address::where('customer_id', '=', $customer->id)->first();
                $response = [
                    'customer' => $customer,
                    'address' => $address,
                ];

                return response()->json($response);
            }
        }

        return response()->json([]);
    }
}
