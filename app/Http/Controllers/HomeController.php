<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('is_featured', '=', 1)->get();
        $data = [
            'products' => $products
        ];
        return view('welcome', $data);
    }

    public function accessDenied()
    {
        return view('access_denied');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        $products = Product::where('is_featured', '=', 1)->get();
        $data = [
            'products' => $products
        ];
        return view('welcome', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_listing()
    {
        return view('user_listing');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $name = trim($request->input('keyword'));
        $catId = $request->input('cat_id');
        $page = 0;

        $products = [];

        if ($name) {
            $products = Product::search($name)->paginate(12);
        }

        if ($catId) {
            $products = Product::where('cat_id', '=', $catId)->paginate(12);
        }

        if (count($products)) {
            if ($name) {
                $products->setPath("search?keyword=$name");
            }
            if ($catId) {
                $products->setPath("search?cat_id=$catId");
            }
        }

        $data = [
            'products' => $products,
            'page' => $page,
        ];
        return view('search', $data);
    }

    public function product(Request $request)
    {
        $id = $request->input('id');
        $productDetail = Product::find($id);

        if (!$productDetail) {
            return redirect('/page-not-found');
        }

        $viewedProducts = session()->get('viewed_products', []);

        if (in_array($id, $viewedProducts)) {
            foreach ($viewedProducts as $key => $productId) {
                if ($id == $productId) {
                    unset($viewedProducts[$key]);
                    break;
                }
            }
        }

        $viewedProducts[] = $id;
        session()->put('viewed_products', $viewedProducts);

        $recentViewedProducts = [];
        foreach ($viewedProducts as $key => $productId) {
            $product = Product::find($productId);
            $recentViewedProducts[] = $product;
        }

        krsort($recentViewedProducts);

        if ($request->submit == 'add-to-cart') {
            $customerId = $request->input('customer-id');
            $sessionId = session()->getId();
            $user = auth()->user();

            $cart = Cart::where('session_id', '=', $sessionId)->first();
            if (!$cart) {
                $cart = new Cart();
                $cart->session_id = $sessionId;
                $cart->customer_id = $customerId;

                if ($user) {
                    $cart->user_id = $user->id;
                }

                $cart->save();
            }

            $cartItem = CartItem::where('product_id', '=', $id)->where('cart_id', '=', $cart->id)->first();

            if (!$cartItem) {
                $cartItem = new CartItem();
                $cartItem->product_id = $id;
                $cartItem->cart_id = $cart->id;
                $cartItem->quantity = 1;
            } else {
                $cartItem->quantity++;
            }

            $cartItem->save();

            return redirect('/product?id=' . $product->id)->with('message', 'This product was just added into your cart!');
        }

        $data = [
            'product' => $productDetail,
            'viewedProducts' => $recentViewedProducts,
        ];

        return view('product', $data);
    }

    public function contact(Request $request)
    {
        if ($request->submit == 'send') {
            $data = [
                'from' => $request->input('email'),
                'subject' => 'Someone contacted us',
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'orderId' => $request->input('order_id'),
                'message' => $request->input('message'),
            ];

            Mail::to('alex@cict.solutions')->send(new Mailer('emails.contact', $data));

            if (Mail::failures()) {
                return redirect('/contact')->with('error', 'Sorry! Please try again later!');
            }

            return redirect('/contact')->with('message', 'We have received your message, someone in our team will try to reach out you soon!');
        }
        return view('contact');
    }
}
