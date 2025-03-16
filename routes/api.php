<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('products', [ProductsController::class, 'index']);
    Route::post('products', [ProductsController::class, 'store']);
    Route::get('products/{product}', [ProductsController::class, 'show']);
    Route::patch('products/{product}', [ProductsController::class, 'update']);
    Route::delete('products/{product}', [ProductsController::class, 'destroy']);

    Route::post('logout', [AuthController::class, 'logout']);
});
