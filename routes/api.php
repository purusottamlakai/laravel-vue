<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
  Route::post('/login', 'login');
  Route::post('/register', 'register');
  Route::post('/user', 'user')->middleware('auth:sanctum');
  Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function() {
  Route::get('/home-data', [HomeController::class, 'getHomeData']);
  Route::apiResource('products', ProductController::class);
  Route::apiResource('users', UserController::class);
});

Route::post('/auth-status', function () {
  return response()->json(['authenticated' => auth()->check()]);
});



