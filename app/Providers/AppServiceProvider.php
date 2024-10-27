<?php

namespace App\Providers;

use App\Models\DaftarKasus;
use App\Observers\KasusObserver;
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
        DaftarKasus::observe(KasusObserver::class);
    }
}
