<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'superadmin' => \App\Http\Middleware\SuperadminMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            '/midtrans/callback',
        ]);
    })

->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Vercel serverless: redirect writable paths to /tmp
if (env('VERCEL') || env('APP_STORAGE_PATH')) {
    $storagePath = env('APP_STORAGE_PATH', '/tmp/storage');
    $app->useStoragePath($storagePath);
    $app->useBootstrapPath('/tmp/bootstrap');
}

return $app;
