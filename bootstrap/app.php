<?php

use App\Helpers\ResponseHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
         
         $exceptions->render(function (ValidationException $e, $request) {
             if ($request->is('api/*')) {
        return ResponseHelper::error('Validation Error',422,$e->errors()) ;
             }
    });
        $exceptions->render(function (ModelNotFoundException $e, $request) {
             if ($request->is('api/*')) {
               Log::error('Model Not Found Exception'.$e->getMessage());
        return ResponseHelper::error('Model Not Found',404);
             }
    });
     $exceptions->render(function (AuthenticationException $e, $request) {
         if ($request->is('api/*')) {
      
        return ResponseHelper::error('Unauthenticated',401);
         }
    });
   
     $exceptions->render(function (AuthorizationException $e, $request) {
         if ($request->is('api/*')) {
       
        return ResponseHelper::error('Unauthorized',403);
         }
    });  
    $exceptions->render(function (\Exception $e, $request) {
    if ($request->is('api/*')) {
        Log::error('General Exception', ['exception' => $e]);
        return ResponseHelper::error('Something went wrong.', 500);
    }
});
    })->create();
