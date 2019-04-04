<?php

namespace App\Listeners\Pages;

use App\Pages\AboutUsPage;
use App\Events\Pages\AboutUsPageCreating;
use App\Exceptions\Pages\AboutUsPageCreationFailed;

class PreventDuplicateAboutUsPage
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
     * @param  AboutUsPageCreating  $event
     * @return void
     */
    public function handle(AboutUsPageCreating $event)
    {
        $existingAboutUsPage = AboutUsPage::first();

        if ($existingAboutUsPage) {
            throw new AboutUsPageCreationFailed("Your site may have only one 'About Us' page at a time.  Modify your current 'About Us' page or delete it and create a new one.");
        }
    }
}
