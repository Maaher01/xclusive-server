<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\WishlistController;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::post('', [OrdersController::class, 'create'])->name('create');
        Route::get('user/{user}', [OrdersController::class, 'getUserOrders'])->name('getUserOrders');
    });

    Route::post('products', [ProductsController::class, 'store'])->name('products.store');
    Route::patch('products/{product}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');

    Route::post('categories', [CategoriesController::class, 'store'])->name('categories.store');

    Route::post('sub-categories', [SubCategoriesController::class, 'store'])->name('sub-categories.store');

    Route::get('wishlist', [WishlistController::class, 'show'])->name('wishlist.show');
    Route::post('wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::prefix('tenants')->name('tenants.')->group(function () {
        Route::post('', [TenantsController::class, 'store'])->name('store');
    });

    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::get('products', [ProductsController::class, 'index'])->middleware('throttle:100,1')->name('products.index');
Route::get('products/{product}', [ProductsController::class, 'show'])->name('products.show');

Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');

Route::get('sub-categories', [SubCategoriesController::class, 'index'])->name('sub-categories.index');
Route::get('sub-categories/{category}', [SubCategoriesController::class, 'getByCategory'])->name('sub-categories.getByCategory');
