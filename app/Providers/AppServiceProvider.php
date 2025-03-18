<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Filesystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->bind('files', Filesystem::class);  //caused memory allocation problem
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
