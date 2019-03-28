<?php

namespace App\Contact;

use Spatie\Valuestore\Valuestore;

class Settings extends Valuestore
{
    public function storeToArray(string $key, string $value)
    {
        $storedEmails = app(Settings::class)->get($key);

        // Initializes empty array in the case when the key does not exist.
        if (empty($storedEmails)) {
            $storedEmails = [];
        }

        $storedEmails[] = $value;

        app(Settings::class)->put($key, $storedEmails);
    }
}
