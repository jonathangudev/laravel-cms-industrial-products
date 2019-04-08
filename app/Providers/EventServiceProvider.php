<?php

namespace App\Providers;


use App\Events\Catalog\Product\AttributeValueCreating;
use App\Events\Pages\HomePageCreating;
use App\Events\Pages\AboutUsPageCreating;
use App\Events\User\Welcomed;
use App\Listeners\Catalog\Product\PreventDuplicateAttributeValue;
use App\Listeners\Pages\PreventDuplicateHomePage;
use App\Listeners\Pages\PreventDuplicateAboutUsPage;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\Logs\LogUserLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Welcomed::class => [
            SendWelcomeEmail::class,
        ],
        AttributeValueCreating::class => [
            PreventDuplicateAttributeValue::class,
        ],
        HomePageCreating::class => [
            PreventDuplicateHomePage::class,
        ],
        AboutUsPageCreating::class => [
            PreventDuplicateAboutUsPage::class,
        ],
        Login::class => [
            LogUserLogin::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
