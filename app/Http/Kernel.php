<?php

namespace SmartLine\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \SmartLine\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \SmartLine\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \SmartLine\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \SmartLine\Http\Middleware\RedirectIfAuthenticated::class,
        'role' => \Bican\Roles\Middleware\VerifyRole::class,
        'permission' => \Bican\Roles\Middleware\VerifyPermission::class,
        'level' => \Bican\Roles\Middleware\VerifyLevel::class,
        'new.user' => \SmartLine\Http\Middleware\NewUser::class,
        'XSS' => \SmartLine\Http\Middleware\XSS::class,
    ];
}
