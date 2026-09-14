<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        $exceptions->render(function (\Throwable $e, Request $request) {
            if (!app()->bound('view')) {
                return response(
                    "<h1>Laravel Application Error</h1>" .
                    "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>" .
                    "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " (line " . $e->getLine() . ")</p>" .
                    "<pre style='background:#f4f4f4;padding:12px;border:1px solid #ccc;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>",
                    500
                )->header('Content-Type', 'text/html');
            }
        });
    })->create();

if ($storagePath = env('APP_STORAGE')) {
    $app->useStoragePath($storagePath);
}

return $app;
