<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'role' => \App\Http\Middleware\Role::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'inactive' => \App\Http\Middleware\Admin\RestrictAccessIfInactive::class,
        'auth.client' => \App\Http\Middleware\AuthenticateClient::class,
        'preventBackHistory' => \App\Http\Middleware\RevalidateBackHistory::class,
        'auth.role.ensure_is_admin' => \App\Http\Middleware\Admin\RestrictAccessIfNotAdmin::class,
        'client.validate.companies' => \App\Http\Middleware\Client\EnsureClientHaveValidCompanies::class,
        'client.validate.config.company' => \App\Http\Middleware\Client\EnsureGlobalCompanyIsSet::class,
        'client.validate.companies.max_count' => \App\Http\Middleware\Client\EnsureClientDidNotReachMaxCompanies::class,
        'client.validate.ensure_project_not_owned_by_client' => \App\Http\Middleware\Client\EnsureClientNotOwnAProject::class,
        'client.validate.ensure_company_dont_have_proposal' => \App\Http\Middleware\Client\EnsureCompanyDontHaveProposal::class,
        'client.validate.ensure_email_dont_exist_on_contacts' => \App\Http\Middleware\Client\EnsureEmailIsNotOnContactList::class,
        'client.validate.ensure_email_dont_exist_on_system' => \App\Http\Middleware\Client\EnsureEmailIsNotOnContactList::class,
    ];
}
