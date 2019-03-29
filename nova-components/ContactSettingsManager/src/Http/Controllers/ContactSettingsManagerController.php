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

        $this->storeToEmailArray('emailRecipients', $newEmail);
    }

    public function storeEmailCc(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $newEmail = $validated['email'];

        $this->storeToEmailArray('emailCcs', $newEmail);
    }

    public function storeEmailBcc(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $newEmail = $validated['email'];

        $this->storeToEmailArray('emailBccs', $newEmail);
    }

    /**
     * DELETE FUNCTIONS
     */
    public function deleteEmailRecipient($index)
    {
        $this->deleteFromEmailArray('emailRecipients', $index);
    }

    public function deleteEmailCc($index)
    {
        $this->deleteFromEmailArray('emailCcs', $index);
    }

    public function deleteEmailBcc($index)
    {
        $this->deleteFromEmailArray('emailBccs', $index);
    }

    /**
     * HELPER METHODS
     */

    /**
     * Delete an item from an array (identified by key) in the Settings valuestore at a particular index.
     * If the index is not in the array, or if the value at that key does not exist, does nothing.
     *
     * @param  string  $key
     * @param  int  $index
     * @return void
     */
    protected function deleteFromEmailArray(string $key, int $index)
    {
        $storedEmails = app(Settings::class)->get($key);

        if (count($storedEmails) > $index + 1) {
            array_splice($storedEmails, $index, 1);
        }

        app(Settings::class)->put($key, $storedEmails);
    }

    /**
     * Pushes a value to an array (identified by key) in the Settings valuestore.
     * If no value exists for that key, creates the array with that value in it.
     *
     * @param  string  $key
     * @param  string  $value
     * @return void
     */
    protected function storeToEmailArray(string $key, string $value)
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
