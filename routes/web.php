<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Contorllers\Client\MessageController;
use App\Http\Controllers\LandingPageController;

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

// Route::redirect('/', '/auth/login');
Route::redirect('/', '/landing-page');


// Route::get('/login', [HomeController::class, 'index'])->middleware('auth');
// Route::redirect('/login', '/admin/login');
Route::redirect('/login', '/auth/login');

Route::get('landing-page', [\App\Http\Controllers\LandingPageController::class, 'index'])->name('home');
Route::get('guest/about', [\App\Http\Controllers\LandingPageController::class, 'about'])->name('guest.about');
Route::get('guest/projects', [\App\Http\Controllers\LandingPageController::class, 'projects'])->name('guest.projects');
Route::get('guest/pricing', [\App\Http\Controllers\LandingPageController::class, 'pricing'])->name('guest.pricing');
Route::get('guest/contact', [\App\Http\Controllers\LandingPageController::class, 'contact'])->name('guest.contact');

// Route::middleware(['auth','inactive', 'preventBackHistory'])->prefix('admin')->name('admin.')->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    Auth::routes();
    
    Route::middleware(['auth','inactive'])->group(function() {
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
        
        Route::get('proposals', [\App\Http\Controllers\Admin\ProposalController::class, 'index'])->name('proposals.index');
        Route::get('proposals/{bidding}', [\App\Http\Controllers\Admin\ProposalController::class, 'show'])->name('proposals.show');
        Route::get('attachments/download/{attachment}', [\App\Http\Controllers\Admin\AttachmentController::class, 'download'])->name('attachments.download');
    
        Route::get('profile/{user}/edit', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile/{user}/update', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    
        Route::get('profile/{user}/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'editPassword'])->name('profile.change-password.form');
        Route::patch('profile/{user}/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('profile.change-password');

        Route::resource('subscription-types', \App\Http\Controllers\Admin\SubscriptionTypeController::class);
        
        Route::post('subscribe/life-time-plan', [\App\Http\Controllers\Admin\SubscribeToLifeTimePlanController::class, 'store'])->name('subscribe.life-time-plan');

        Route::get('payments', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
        Route::get('payments/{payment}', [\App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('payments.show');
    });
});


Route::name('client.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function() {
        Route::get('login', [\App\Http\Controllers\Client\Auth\LoginController::class, 'showLoginForm'])->name('show-login-form');
        Route::post('login', [\App\Http\Controllers\Client\Auth\LoginController::class, 'login'])->name('login');
        Route::get('register', [\App\Http\Controllers\Client\Auth\RegisterController::class, 'showRegisterForm'])->name('show-register-form');
        Route::post('register', [\App\Http\Controllers\Client\Auth\RegisterController::class, 'register'])->name('register');
    });
    
    // Route::middleware(['auth.client', 'preventBackHistory'])->group(function() {
    // Route::middleware(['auth.client', 'client.validate.redirect_if_with_pending_transaction'])->group(function() {
    Route::middleware(['auth.client'])->group(function() {
        Route::post('logout', [\App\Http\Controllers\Client\Auth\LoginController::class, 'logout'])->name('auth.logout');
        Route::get('dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');

        Route::middleware(['client.validate.ensure_client_have_subscription', 'client.validate.ensure_client_subscription_is_not_expire'])
        ->group(function() {
            Route::resource('companies', \App\Http\Controllers\Client\CompanyController::class);
            Route::post('companies/{company}/requirements', [\App\Http\Controllers\Client\CompanyRequirementController::class, 'store'])->name('companies.requirements.store');
            Route::get('companies/{company}/requirements/{requirement}/download', [\App\Http\Controllers\Client\CompanyRequirementController::class, 'download'])->name('companies.requirements.download');
            Route::delete('companies/{company}/requirements/{requirement}', [\App\Http\Controllers\Client\CompanyRequirementController::class, 'destroy'])->name('companies.requirements.destroy');
    
            Route::patch('projects/set-status/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'setStatus']);
    
            Route::middleware('client.validate.companies')
            ->get('projects/create', [\App\Http\Controllers\Client\ProjectController::class, 'create'])
            ->name('projects.create');
    
            Route::patch('projects/set-winner/{project}', [\App\Http\Controllers\Client\ProjectController::class, 'setWinner'])->name('projects.set-winner');
            Route::get('projects/{project}/proposals', [\App\Http\Controllers\Client\ProjectController::class, 'proposals'])->name('projects.proposals');
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
            Route::delete('proposals/{bidding}/cancel', [\App\Http\Controllers\Client\ProposalController::class, 'cancel'])->name('proposals.cancel');
            Route::patch('config/set-company', [\App\Http\Controllers\Client\SessionConfigController::class, 'update'])->name('global.config.update');
    
            Route::get('attachments/download/{attachment}', [\App\Http\Controllers\Client\AttachmentController::class, 'download'])->name('attachments.download');
        
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
        });

        Route::get('notifications', [\App\Http\Controllers\Client\NotificationController::class, 'index'])->name('notifications.index');
        Route::get('notifications/{notification}', [\App\Http\Controllers\Client\NotificationController::class, 'show'])->name('notifications.show');
        Route::delete('notifications/{notification}', [\App\Http\Controllers\Client\NotificationController::class, 'destroy'])->name('notifications.delete');

        Route::resource('labels', \App\Http\Controllers\Client\LabelController::class);

        Route::get('profile/{client}', [\App\Http\Controllers\Client\ProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/{client}/edit', [\App\Http\Controllers\Client\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile/{client}/update', [\App\Http\Controllers\Client\ProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/{client}/change-password', [\App\Http\Controllers\Client\ProfileController::class, 'editPassword'])->name('profile.change-password.form');
        Route::patch('profile/{client}/change-password', [\App\Http\Controllers\Client\ProfileController::class, 'changePassword'])->name('profile.change-password');

        Route::get('products', [\App\Http\Controllers\Client\ProductController::class, 'index'])->name('products.index');
        Route::get('products/{subscription_type}/billing', [\App\Http\Controllers\Client\BillingController::class, 'create'])->name('billings.create');
        Route::post('products/{subscription_type}/checkout', [\App\Http\Controllers\Client\BillingController::class, 'store'])->name('billings.checkout');
        
        Route::get('invoice/{payment}', [\App\Http\Controllers\Client\InvoiceController::class, 'show'])->name('invoice.show');

        Route::get('subscriptions/{subscription}/unsubcribe', [\App\Http\Controllers\Client\SubscriptionController::class, 'unsubscribe'])->name('subscriptions.unsubscribe');
        Route::post('subscriptions/{subscription_type}/subscribe', [\App\Http\Controllers\Client\SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');

        Route::get('payments/result', [\App\Http\Controllers\Client\PaymentController::class, 'result'])->name('payments.result');
        Route::get('payments', [\App\Http\Controllers\Client\PaymentController::class, 'index'])->name('payments.index');
        Route::get('payments/{payment}', [\App\Http\Controllers\Client\PaymentController::class, 'show'])->name('payments.show');
        Route::get('payments/{payment}/print', [\App\Http\Controllers\Client\PaymentController::class, 'print'])->name('payments.print');
    });

});

