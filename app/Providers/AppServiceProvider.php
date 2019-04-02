<?php

namespace App\Providers;

use App\Contact\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Laravel 5.4 made a change to the default database character set, and it’s now utf8mb4 which includes support for storing emojis.
        // Versions of MySQL <5.7.7 need the below fix.
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Registers App\Contact\Settings, which extends spatie\valuestore
        $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings/contact.json'));
        });
    }
}
