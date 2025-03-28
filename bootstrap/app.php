<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectLogin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->name('dashboard.')
                ->prefix('dashboard')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('login');
        $middleware->alias([
            'redirect.employee' => \App\Http\Middleware\RedirectEmployeePanel::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();