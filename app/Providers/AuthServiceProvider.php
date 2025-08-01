<?php

namespace App\Providers;

use App\Policies\ProductPolicy;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class,
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
