<?php

namespace Jmp\ContactSettingsManager\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contact\Settings;
use Illuminate\Http\Request;

class ContactSettingsManagerController extends Controller
{
    /**
     * GET FUNCTIONS
     */
    public function getEmailRecipients()
    {
        $result = app(Settings::class)->get('emailRecipients');

        return response()->json($result);
    }

    public function getEmailCcs()
    {
        $result = app(Settings::class)->get('emailCcs');

        return response()->json($result);
    }

    public function getEmailBccs()
    {
        $result = app(Settings::class)->get('emailBccs');

        return response()->json($result);
    }

    /**
     * STORE FUNCTIONS
     */
    public function storeEmailRecipient(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $newEmail = $validated['email'];

        app(Settings::class)->storeToArray('emailRecipients', $newEmail);
    }

    // TODO add more

    /**
     * DELETE FUNCTIONS
     */
    public function deleteEmailRecipient($index)
    {
        $this->deleteFromEmailArray('emailRecipients', $index);
    }

    // TODO add more

    /**
     * HELPER METHODS
     */
    protected function deleteFromEmailArray(string $key, int $index)
    {
        $storedEmails = app(Settings::class)->get($key);

        // Initializes empty array in the case when the key does not exist.
        if (empty($storedEmails)) {
            $storedEmails = [];
        }

        // TODO - when index isn't there?
        array_splice($storedEmails, $index, 1);

        app(Settings::class)->put($key, $storedEmails);
    }
}
