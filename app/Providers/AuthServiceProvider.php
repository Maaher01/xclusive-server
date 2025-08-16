<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Policies\ProductPolicy;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Wishlist;
use App\Policies\CartItemPolicy;
use App\Policies\CartPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\OrderPolicy;
use App\Policies\SubCategoryPolicy;
use App\Policies\UserPolicy;
use App\Policies\WishlistPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        SubCategory::class => SubCategoryPolicy::class,
        Cart::class => CartPolicy::class,
        CartItem::class => CartItemPolicy::class,
        Order::class => OrderPolicy::class,
        Wishlist::class => WishlistPolicy::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
