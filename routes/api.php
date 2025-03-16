<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('products', [ProductsController::class, 'index']);
Route::post('products', [ProductsController::class, 'store']);
Route::get('products/{product}', [ProductsController::class, 'show']);
Route::patch('products/{product}', [ProductsController::class, 'update']);
Route::delete('products/{product}', [ProductsController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

