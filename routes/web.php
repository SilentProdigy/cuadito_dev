<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/access-denied', [HomeController::class, 'accessDenied'])->name('access-denied');

Route::match(['get', 'post'], '/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::match(['get', 'post'], '/product', [HomeController::class, 'product'])->name('product');

Route::get('/register/confirmation', [RegisterController::class, 'confirmation'])->name('confirmation');

Route::match(['get', 'post'], '/cart', [CartController::class, 'myCart'])->name('my-cart');

Route::get('/checkout/confirmation', [CartController::class, 'confirmation'])->name('confirmation');

Route::get('/search/customer', [OrderController::class, 'searchCustomer'])->name('searchCustomer');

Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('myOrders');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin-dashboard');

Route::get('/dashboard/user_listing', [DashboardController::class, 'show_users'])->name('user_listing');

Route::get('/dashboard/orders', [DashboardController::class, 'showOrders'])->name('orders');
Route::get('/dashboard/product-listing', [ProductController::class, 'index'])->name('product-listing');

// Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
Route::get('profile/{id}', ['uses' => 'App\Http\Controllers\DashboardController@profile', 'as' => 'profile']);

Route::get('/invoice', [OrderController::class, 'invoice'])->name('invoice');

Auth::routes();
