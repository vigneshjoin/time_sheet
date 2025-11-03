<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('table', \App\View\Components\Table::class);
         // Define a global variable
        // $home = route('dashboard');

        // // Share it with all views
        // View::share('HOME_URL', $home);

        // // Share it with controllers
        // Config::set('app.HOME_URL', $home);
    }
}
