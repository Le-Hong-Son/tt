<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->prepend(\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class);
        // $middleware->append(\App\Http\Middleware\CheckAdminMiddleware::class); // append 
        $middleware->alias([ 
        'role' => \App\Http\Middleware\CheckAdminMiddleware::class,
        'verify' => \App\Http\Middleware\CheckAdminMiddleware::class, 
        'verify-register' => \App\Http\Middleware\CheckAdminMiddleware::class, 
        'verify-register2' => \App\Http\Middleware\CheckAdminMiddleware::class,
        // 'admin' => \App\Http\Middleware\CheckAdmin::class,
        // 'user' => \App\Http\Middleware\UserMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    
