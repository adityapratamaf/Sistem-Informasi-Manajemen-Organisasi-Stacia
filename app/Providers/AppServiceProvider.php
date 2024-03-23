<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Ganti Waktu Lokal Indonesia
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Ganti Waktu Lokal Indonesia
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
}
