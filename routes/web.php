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

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

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

// Route::get('/dashboard/user_listing', [DashboardController::class, 'show_users'])->name('user_listing');

Route::get('/dashboard/orders', [DashboardController::class, 'showOrders'])->name('orders');
Route::get('/dashboard/product-listing', [ProductController::class, 'index'])->name('product-listing');

// Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
Route::get('profile/{id}', ['uses' => 'App\Http\Controllers\DashboardController@profile', 'as' => 'profile']);

Route::get('/invoice', [OrderController::class, 'invoice'])->name('invoice');

Auth::routes();



// Route::middleware(['auth','inactive', 'preventBackHistory'])->prefix('admin')->name('admin.')->group(function () {
Route::middleware(['auth','inactive'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/{user}', [\App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile.show');

    Route::patch('/users/set-status/{user}', [\App\Http\Controllers\Admin\UserController::class, 'setStatus'])->name('set-status');
    Route::patch('/users/change-password/{user}', [\App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('change-password');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('companies', \App\Http\Controllers\Admin\CompanyController::class);
    Route::get('companies/{company}/requirements/{requirement}/download', [\App\Http\Controllers\Admin\CompanyRequirementController::class, 'download'])->name('companies.requirements.download');
    Route::resource('requirements', \App\Http\Controllers\Admin\RequirementController::class);
});


Route::prefix('client')->name('client.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function() {
        Route::get('login', [\App\Http\Controllers\Client\Auth\LoginController::class, 'showLoginForm'])->name('show-login-form');
        Route::post('login', [\App\Http\Controllers\Client\Auth\LoginController::class, 'login'])->name('login');
        Route::get('register', [\App\Http\Controllers\Client\Auth\RegisterController::class, 'showRegisterForm'])->name('show-register-form');
        Route::post('register', [\App\Http\Controllers\Client\Auth\RegisterController::class, 'register'])->name('register');
        Route::post('logout', [\App\Http\Controllers\Client\Auth\LoginController::class, 'logout'])->name('logout');
    });

    // Route::middleware(['auth.client', 'preventBackHistory'])->group(function() {
    Route::middleware(['auth.client'])->group(function() {
    
        Route::get('dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('companies', \App\Http\Controllers\Client\CompanyController::class);
        Route::post('companies/{company}/requirements', [\App\Http\Controllers\Client\CompanyRequirementController::class, 'store'])->name('companies.requirements.store');
        Route::get('companies/{company}/requirements/{requirement}/download', [\App\Http\Controllers\Client\CompanyRequirementController::class, 'download'])->name('companies.requirements.download');
        Route::delete('companies/{company}/requirements/{requirement}', [\App\Http\Controllers\Client\CompanyRequirementController::class, 'destroy'])->name('companies.requirements.destroy');

        Route::patch('projects/set-status/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'setStatus']);

        Route::middleware('client.validate.companies')
        ->get('projects/create', [\App\Http\Controllers\Client\ProjectController::class, 'create'])
        ->name('projects.create');

        Route::get('projects', [\App\Http\Controllers\Client\ProjectController::class, 'index'])->name('projects.index');
        Route::get('projects/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'show'])->name('projects.show');

        Route::post('projects', [\App\Http\Controllers\Client\ProjectController::class, 'store'])->name('projects.store');
        Route::get('projects/edit/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'edit'])->name('projects.edit');
        Route::patch('projects/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'update'])->name('projects.update');
        Route::delete('projects/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'destroy'])->name('projects.delete');   
        
        Route::get('listing', [\App\Http\Controllers\Client\ProjectListingController::class, 'index'])->name('listing.index');
        Route::get('listing/{project}', [\App\Http\Controllers\Client\ProjectListingController::class, 'show'])->name('listing.show');
        
        Route::middleware('client.validate.config.company')->group(function() {
            Route::get('proposal/create/{project}',[\App\Http\Controllers\Client\ProposalController::class, 'create'])->name('proposals.create');
            Route::post('proposal/{project}',[\App\Http\Controllers\Client\ProposalController::class, 'store'])->name('proposals.store');
        });

        Route::patch('config/set-company', [\App\Http\Controllers\Client\SessionConfigController::class, 'update'])->name('global.config.update');
    });

});

