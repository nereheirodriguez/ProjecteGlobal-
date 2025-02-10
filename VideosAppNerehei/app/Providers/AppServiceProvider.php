<?php

namespace App\Providers;

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
        $authServiceProvider = new AuthServiceProvider($this->app);
        $authServiceProvider->registerPolicies();
        $authServiceProvider->define_gates();
        $authServiceProvider->create_permissions();
    }
}
