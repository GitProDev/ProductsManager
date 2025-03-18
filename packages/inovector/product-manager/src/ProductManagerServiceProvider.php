<?php

namespace Inovector\ProductManager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Seeder;

class ProductManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'product-manager');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

       $this->loadSeeders();
    }

    protected function loadSeeders()
    {
        $this->callAfterResolving(Seeder::class, function ($seeder) {
            $seeder->call([
                \Inovector\ProductManager\Database\Seeders\SellerSeeder::class,
                \Inovector\ProductManager\Database\Seeders\CategorySeeder::class,
                \Inovector\ProductManager\Database\Seeders\ProductSeeder::class
            ]);
        });
    }

    public function register()
    {
        // Register config
        $this->mergeConfigFrom(__DIR__.'/config/product-manager.php', 'product-manager');        
    }
}
