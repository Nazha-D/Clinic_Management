<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests\LoginRequest;
use App\Http\Requests\UserRequests\ResetPasswordRequest;
use App\Http\Requests\UserRequests\StoreUserRequest;
use App\Http\Requests\UserRequests\UpdateUserRequest;
use App\Services\AuthService;
use App\Traits\ResponseTrait;


class AuthController extends Controller
{ 
    use ResponseTrait;
    private AuthService $authService;
   public function __construct(AuthService $authService)
   {
    $this->authService=$authService;
    }
public function register(StoreUserRequest $request)
{
   
      $user= $this->authService->register($request->validated());
      $message='User created successfully';
    return $this->successResponse($user,$message,201);
  
   
}
public function login(LoginRequest $request)
{
   
      $user= $this->authService->login($request->validated());
      $message='User logged in successfully';
    return $this->successResponse($user,$message,200);
  
   
}

public function logout()
{  
     $this->authService->logout();
      $message='User logged out successfully';
    return $this->successResponse([],$message,200);
  
}
public function resetPassword(ResetPasswordRequest $request)
{  

    $user= $this->authService->resetPassword($request->validated());
      $message='Password reset successfully';
    return $this->successResponse($user,$message,200);
  
}
public function updateUser(UpdateUserRequest $request)
{  

    $user= $this->authService->updateUser($request->validated());
      $message='User updated successfully';
    return $this->successResponse($user,$message,200);
  
}
}
