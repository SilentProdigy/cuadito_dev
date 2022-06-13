<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Customer;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
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

    public function myCart(Request $request)
    {
        $sessionId = session()->getId();
        $user = auth()->user();
        $cart = Cart::where('session_id', '=', $sessionId)->first();
        $cartItems = [];
        $totalAmount = 0;

        if (is_array($request->input('remove'))) {
            foreach ($request->input('remove') as $cartItemId => $value) {
                $cartItem = CartItem::find($cartItemId);
                $cartItem->delete();
            }
        }

        if ($cart) {
            if ($request->submit == 'save' || $request->submit == 'checkout') {
                $quantities = $request->input('quantity');
                foreach ($quantities as $cartItemId => $quantity) {
                    $cartItem = CartItem::find($cartItemId);
                    $product = Product::find($cartItem->product_id)->first();

                    if ($quantity > $product->quantity) {
                        return redirect('/cart')->with('error', 'Product <b>' . $product->name . '</b> has only ' . $product->quantity . ' items remaining');
                    }

                    $cartItem->quantity = $quantity;
                    $cartItem->save();
                }
            }

            $cartItems = CartItem::leftJoin('products', function ($join) {
                $join->on('cart_items.product_id', '=', 'products.id');
            })->where('cart_items.cart_id', '=', $cart->id)
                ->get([
                    'cart_items.id',
                    'cart_items.product_id',
                    'cart_items.quantity',
                    'products.name',
                    'products.picture',
                    'products.price'
                ]);

            $totalAmount = 0;
            foreach ($cartItems as $key => $cartItem) {
                $subTotal = $cartItem->quantity * $cartItem->price;
                $totalAmount += $subTotal;
                $cartItems[$key]->total = $subTotal;
            }
        }

        $data = [
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount
        ];

        if ($cart && $request->submit == 'checkout') {
            $order = new Order();
            $order->user_id = $user->id;
            $order->customer_id = $cart->customer_id;
            $order->total_amount = $totalAmount;
            $order->status = 'UNPAID';
            $order->save();

            foreach ($cartItems as $key => $cartItem) {
                $subTotal = $cartItem->quantity * $cartItem->price;
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cartItem->product_id;
                $orderItem->quantity = $cartItem->quantity;
                $orderItem->total_item_amount = $subTotal;
                $orderItem->save();
                $cartItem->delete();

                $product = Product::find($cartItem->product_id)->first();
                $product->quantity -= $cartItem->quantity;

                if ($product->quantity < 0) {
                    $product->quantity = 0;
                }

                $product->save();
            }

            $cart->delete();

            $customer = null;
            if ($cart && $cart->customer_id) {
                $customer = Customer::find($cart->customer_id);
            }

            $data['subject'] = 'Your order #' . $order->id . ' has been placed!';
            $data['name'] = $customer ? $customer->name : $user->name;

            $email = $customer ? $customer->email : $user->email;

            Mail::to($email)->send(new Mailer('emails.order', $data));

            if (Mail::failures()) {
                return redirect('/cart')->with('error', 'Sorry! Please try again later!');
            }

            session(['order_id' => $order->id]);

            return redirect('/checkout/confirmation')->with('message', 'Your order has been placed sucessfully!');
        }

        return view('cart', $data);
    }

    public function confirmation()
    {
        return view('order_confirmation');
    }
}
