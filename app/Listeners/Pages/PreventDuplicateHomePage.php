<?php

namespace App\Listeners\Pages;

use App\Pages\HomePage;
use App\Events\Pages\HomePageCreating;
use App\Exceptions\Pages\HomePageCreationFailed;

class PreventDuplicateHomePage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  HomePageCreating  $event
     * @return void
     */
    public function handle(HomePageCreating $event)
    {
        $existingHomePage = HomePage::first();

        if ($existingHomePage) {
            throw new HomePageCreationFailed("Your site may have only one home page at a time.  Modify your current home page or delete it and create a new one.");
        }
    }
}
