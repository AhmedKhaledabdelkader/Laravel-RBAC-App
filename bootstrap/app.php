<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
    

        $middleware->alias([
            
            'validate.user' => \App\Http\Middleware\ValidateUser::class,
            'validate.modifyRole' => \App\Http\Middleware\ValidateRoleModification::class,
            'validate.admin' => \App\Http\Middleware\AdminMiddleware::class,
            'validate.userLogin' => \App\Http\Middleware\ValidateAuthentication::class,
            'auth' => \App\Http\Middleware\AuthMiddleware::class,
            'premission' => \App\Http\Middleware\PremissionMiddleware::class,

]);



    })
    ->withExceptions(function (Exceptions $exceptions): void {



        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Route not found'
            ], 404);
        });




     
        $exceptions->render(function (Throwable $e, $request) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        });



        
    })->create();
