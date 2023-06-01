<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService();
        });

        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
