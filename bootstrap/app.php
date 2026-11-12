<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            Route::middleware('web')
            ->prefix('jadwal')
            ->name('jadwal.')
            ->group(base_path('routes/jadwal.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'auth.any' => \App\Http\Middleware\AuthAny::class,
    ]);

    $middleware->redirectGuestsTo(fn () => route('login'));
    $middleware->redirectUsersTo(fn () => route('profil'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
    
    
    
