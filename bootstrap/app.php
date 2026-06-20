<?php

use App\Http\Middleware\SetLangMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // ->prefix('dashboard')
            // ->name('dashboard')

            // web
            Route::middleware('web')->group(base_path('routes/dashboard.php'));
            //api
            Route::middleware('api')->prefix('api/v1')->group(base_path('routes/api/admin.php'));
            Route::middleware('api')->prefix('api/v1')->group(base_path('routes/api/user.php'));
            Route::middleware('api')->prefix('api/v1')->group(base_path('routes/api/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // redirect if not auth
        $middleware->redirectGuestsTo(function () {
            if (request()->is('*/dashboard/*')) {
                return route('dashboard.get.login');
            } else {
                return route('website.index');
            }
        });

        // redirect if auth
        $middleware->redirectUsersTo(function () {
            if (Auth::guard('admin')->check()) {
                return route('dashboard.index');
            } else {
                return route('website.index');
            }
        });

        $middleware->alias([
            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,

            //'setLanguage' => SetLangMiddleware::class,
        ]);

        $middleware->api(prepend: [SetLangMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
