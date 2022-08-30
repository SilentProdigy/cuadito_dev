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
        
        View::composer(['client.projects.create', 'client.projects.edit'], function($view)
        {
            $categories = Category::all();

            $view->with(compact('categories'));
        });

        View::composer(['client.inbox.includes.*'], function($view)
        {    
            $client = auth('client')->user();

            $unread_data = [
                'inbox' => $client->unread_conversations_count,
                'important' => $client->unread_important_conversations_count,
            ];

            $view->with(compact('unread_data'));
        });


        # Will create a new blade directive money
        Blade::directive('money', function ($amount) {

            $amount = is_string($amount) ? $amount : number_format($amount, 2, '.', ',');

            return "<span style='font-family: DejaVu Sans; sans-serif;'>&#8369;<?= $amount ?></span>";
        });
    }
}
