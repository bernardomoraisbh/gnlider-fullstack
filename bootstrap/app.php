<?php

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\TransformInputKeys;
use App\Http\Middleware\TransformOutputKeys;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            TransformInputKeys::class, // Add your middleware here
        ]);
        $middleware->api(append: [
            TransformOutputKeys::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            '/logout'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
