<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TenantsController;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum', 'throttle:100,1'])->group(function () {
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('', [ProductsController::class, 'index'])->name('index');
        Route::post('', [ProductsController::class, 'store'])->name('store');
        Route::get('{product}', [ProductsController::class, 'show'])->name('show');
        Route::patch('{product}', [ProductsController::class, 'update'])->name('update');
        Route::delete('{product}', [ProductsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::post('', [OrdersController::class, 'create'])->name('create');
        Route::get('get-all-user-orders/{user}', [OrdersController::class, 'getUserOrders'])->name('getUserOrders');
    });

    Route::prefix('tenants')->name('tenants.')->group(function () {
        Route::post('onboard', [TenantsController::class, 'onboardTenant'])->name('onboard');
    });

    Route::post('logout', [AuthController::class, 'logout']);
});
