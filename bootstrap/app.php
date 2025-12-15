<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckIsLogin;
use App\Http\Middleware\CheckRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'checkIsLogin' => CheckIsLogin::class,
            'role' => CheckRole::class  // PERUBAHAN: 'role' bukan 'checkrole'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();