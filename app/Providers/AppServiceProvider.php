<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
 
        View::composer('*', function($view)
        {
            $categories = Category::where('parent_id', '=', 0)->orderBy('ordering')->get();
            
            foreach ($categories as $key => $category) {
                $subCategories = Category::where('parent_id', '=', $category->id)->orderBy('ordering')->get();
                $category->subCategories = $subCategories;
                $categories[$key] = $category;
            }

            $cartTotalItems = 0;
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', '=', $sessionId)->first();

            if ($cart) {
                $cartItems = CartItem::where('cart_id', '=', $cart->id)->get();
                $cartTotalItems = $cartItems->count();
            }
            
            $view->with('categories', $categories);
            $view->with('cartTotalItems', $cartTotalItems);
        });
    }
}
