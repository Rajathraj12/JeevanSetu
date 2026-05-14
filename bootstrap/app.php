<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('admissions*') || $request->is('bed-map*') || $request->is('inventory*') || $request->is('doctor-schedule*') || $request->is('wait-board*')) {
                return route('login', ['role' => 'admin']);
            }
            if ($request->is('city-beds*')) {
                return route('login', ['role' => 'patient']);
            }
            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
