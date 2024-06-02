<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
  Route::post('/login', 'login');
  Route::post('/register', 'register');
});

Route::group([], function() {
  Route::get('logout', [AuthController::class, 'logout']);
    Route::get('/home-data', function() {
      return response()->json([
          'user_count' => \App\Models\User::count(),
          'product_count' => \App\Models\Product::count()
      ]);
  });

  Route::apiResource('products', ProductController::class);
  Route::apiResource('users', UserController::class);
});



