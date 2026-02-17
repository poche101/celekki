<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registering your Custom Middleware Alias
        $middleware->alias([
            'live.access' => \App\Http\Middleware\EnsureLiveAccess::class,
        ]);

        // You can also add global middleware or append to groups here
        // $middleware->append(\App\Http\Middleware\GlobalLogger::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle custom exceptions here
    })
    ->create();