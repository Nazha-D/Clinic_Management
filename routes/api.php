<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('users/register',[AuthController::class,'register']);
Route::post('users/login',[AuthController::class,'login']);
Route::group(['middleware'=>'auth:sanctum',
             'prefix'=>'users',
              'controller'=>AuthController::class
             ],function(){

Route::post('/log-out','logout');
Route::put('/update','updateUser');
  Route::put('/reset-password', 'resetPassword');
});