<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Contorllers\Client\MessageController;

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

// Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::redirect('/', '/client/auth/login');
Route::get('/login', [HomeController::class, 'index'])->middleware('auth');

Route::get('/landing-page', function(){
    return view('landing-page');
});

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
    Route::patch('requirements/set-status/{company_requirement}', [\App\Http\Controllers\Admin\CompanyRequirementController::class, 'update'])->name('requirements.set-status');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);
    Route::patch('projects/set-status/{project}', [\App\Http\Controllers\Admin\ProjectListingController::class, 'setStatus']);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectListingController::class);

    Route::get('proposals/{bidding}', [\App\Http\Controllers\Admin\ProposalController::class, 'show'])->name('proposals.show');
    Route::get('attachments/download/{attachment}', [\App\Http\Controllers\Admin\AttachmentController::class, 'download'])->name('attachments.download');
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

        Route::patch('projects/set-winner/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'setWinner'])->name('projects.set-winner');
        Route::get('projects', [\App\Http\Controllers\Client\ProjectController::class, 'index'])->name('projects.index');
        Route::get('projects/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'show'])->name('projects.show');

        Route::post('projects', [\App\Http\Controllers\Client\ProjectController::class, 'store'])->name('projects.store');
        Route::get('projects/edit/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'edit'])->name('projects.edit');
        Route::patch('projects/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'update'])->name('projects.update');
        Route::delete('projects/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'destroy'])->name('projects.delete');   
                        
        Route::middleware('client.validate.config.company')->group(function() {
            Route::get('listing', [\App\Http\Controllers\Client\ProjectListingController::class, 'index'])->name('listing.index');
            Route::get('listing/{project}', [\App\Http\Controllers\Client\ProjectListingController::class, 'show'])->name('listing.show');
            Route::get('proposal/create/{project}',[\App\Http\Controllers\Client\ProposalController::class, 'create'])->name('proposals.create');
            Route::post('proposal/{project}',[\App\Http\Controllers\Client\ProposalController::class, 'store'])->name('proposals.store');
        });

        Route::get('proposals', [\App\Http\Controllers\Client\ProposalController::class, 'index'])->name('proposals.index');
        Route::get('proposals/{bidding}', [\App\Http\Controllers\Client\ProposalController::class, 'show'])->name('proposals.show');
        Route::patch('config/set-company', [\App\Http\Controllers\Client\SessionConfigController::class, 'update'])->name('global.config.update');

        Route::get('attachments/download/{attachment}', [\App\Http\Controllers\Client\AttachmentController::class, 'download'])->name('attachments.download');
        
        Route::get('notifications', [\App\Http\Controllers\Client\NotificationController::class, 'index'])->name('notifications.index');
        Route::get('notifications/{notification}', [\App\Http\Controllers\Client\NotificationController::class, 'show'])->name('notifications.show');
        // Route::patch('notifications/{notification}', [\App\Http\Controllers\Client\NotificationController::class, 'update'])->name('notifications.update');
        Route::delete('notifications/{notification}', [\App\Http\Controllers\Client\NotificationController::class, 'destroy'])->name('notifications.delete');
        
        Route::get('conversations/create', [\App\Http\Controllers\Client\ConversationController::class, 'create'])->name('conversations.create');
        Route::get('conversations', [\App\Http\Controllers\Client\ConversationController::class, 'index'])->name('conversations.index');
        Route::get('conversations/{conversation}', [\App\Http\Controllers\Client\ConversationController::class, 'show'])->name('conversations.show');
        Route::post('conversations', [\App\Http\Controllers\Client\ConversationController::class, 'store'])->name('conversations.store');

        // Route::get('convo-subs/unread/{conversationSubscription}', [\App\Http\Controllers\Client\ConversationSubscriptionController::class, 'unread'])->nam        
        Route::post('convo-subs/unread', [\App\Http\Controllers\Client\ConversationSubscriptionController::class, 'unread'])->name('conversation-subs.unread');
        Route::post('convo-subs/star', [\App\Http\Controllers\Client\ConversationSubscriptionController::class, 'star'])->name('conversation-subs.star');
        Route::post('convo-subs/important', [\App\Http\Controllers\Client\ConversationSubscriptionController::class, 'important'])->name('conversation-subs.important');
        Route::post('convo-subs/archive', [\App\Http\Controllers\Client\ConversationSubscriptionController::class, 'archive'])->name('conversation-subs.archive');
        Route::delete('convo-subs/delete', [\App\Http\Controllers\Client\ConversationSubscriptionController::class, 'destroy'])->name('conversation-subs.delete');
        Route::patch('convo-subs/set-labels', [\App\Http\Controllers\Client\ConversationSubscriptionController::class, 'setLabel'])->name('conversation-subs.set-labels');
        

        Route::post('messages/{conversation}', [\App\Http\Controllers\Client\MessageController::class, 'store'])->name('messages.store');

        Route::get('inbox', [\App\Http\Controllers\Client\InboxController::class, 'inbox'])->name('inbox.index');
        Route::get('inbox/starred', [\App\Http\Controllers\Client\InboxController::class, 'starred'])->name('inbox.starred');
        Route::get('inbox/archived', [\App\Http\Controllers\Client\InboxController::class, 'archived'])->name('inbox.archived');
        Route::get('inbox/important', [\App\Http\Controllers\Client\InboxController::class, 'important'])->name('inbox.important');
        Route::get('inbox/sent', [\App\Http\Controllers\Client\InboxController::class, 'sent'])->name('inbox.sent');

        Route::get('contacts/invite/{contact}', [\App\Http\Controllers\Client\ContactController::class, 'invite'])->name('contacts.invite');
        // Route::resource('contacts', \App\Http\Controllers\Client\ContactController::class);
        Route::get('contacts', [\App\Http\Controllers\Client\ContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/create', [\App\Http\Controllers\Client\ContactController::class, 'create'])->name('contacts.create');
        Route::post('contacts', [\App\Http\Controllers\Client\ContactController::class, 'store'])->name('contacts.store');
        Route::delete('contacts', [\App\Http\Controllers\Client\ContactController::class, 'destroy'])->name('contacts.delete');

        Route::post('connect', [\App\Http\Controllers\Client\ConnectionController::class, 'store'])->name('connect.store');

        Route::resource('labels', \App\Http\Controllers\Client\LabelController::class);
    });

});

