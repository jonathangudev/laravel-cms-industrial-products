<?php

namespace App\Listeners\Pages;

use App\Pages\AboutUs;
use App\Events\Pages\AboutUsPage;
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
     * @param  AboutUsPage  $event
     * @return void
     */
    public function handle(AboutUsPage $event)
    {
        $existingValue = AboutUsPage::first();

        if ($existingValue) {
            throw new AboutUsPageCreationFailed("Your site may have only one About Us page at a time.  Modify your current home page or delete it and create a new one.");
        }
    }
}
