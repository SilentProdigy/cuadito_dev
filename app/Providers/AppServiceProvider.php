<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Blade;

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
            /*     
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
            */
        });

        # Will create a new blade directive money
        Blade::directive('money', function ($amount) {

            $amount = is_string($amount) ? $amount : number_format($amount, 2, '.', ',');

            return "<span style='font-family: DejaVu Sans; sans-serif;'>&#8369;<?= $amount ?></span>";
        });
    }
}
