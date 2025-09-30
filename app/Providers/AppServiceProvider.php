<?php

namespace App\Providers;

use App\Services\CryptoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('crypto', fn() => new CryptoService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
