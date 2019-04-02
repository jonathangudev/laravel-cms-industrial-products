<?php

namespace Jmp\ContactSettingsManager\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contact\Settings;
use Illuminate\Http\Request;

class ContactSettingsManagerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @param Settings $settings
     * @return void
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * GET FUNCTIONS
     */

    /**
     * Get all email recipients
     *
     * @return json
     */
    public function getEmailRecipients()
    {
        $result = app(Settings::class)->get('emailRecipients');

        return response()->json($result);
    }

    /**
     * Get all email ccs
     *
     * @return json
     */
    public function getEmailCcs()
    {
        $result = app(Settings::class)->get('emailCcs');

        return response()->json($result);
    }

    /**
     * Get all email ccs
     *
     * @return json
     */
    public function getEmailBccs()
    {
        $result = app(Settings::class)->get('emailBccs');

        return response()->json($result);
    }

    /**
     * STORE FUNCTIONS
     */

    /**
     * Saves the email from the request into the email recipients array in the Contact\Settings valuestore
     * 
     * @param Request $request
     * @return void
     */
    public function storeEmailRecipient(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $newEmail = $validated['email'];

        $this->storeToEmailArray('emailRecipients', $newEmail);
    }

    /**
     * Saves the email from the request into the email ccs array in the Contact\Settings valuestore
     * 
     * @param Request $request
     * @return void
     */
    public function storeEmailCc(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $newEmail = $validated['email'];

        $this->storeToEmailArray('emailCcs', $newEmail);
    }

    /**
     * Saves the email from the request into the email bccs array in the Contact\Settings valuestore
     * 
     * @param Request $request
     * @return void
     */
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

    /**
     * Deletes the email at the specified index from the email recipients array in the Contact\Settings valuestore
     * 
     * @param $index
     * @return void
     */
    public function deleteEmailRecipient($index)
    {
        $this->deleteFromEmailArray('emailRecipients', $index);
    }

    /**
     * Deletes the email at the specified index from the email ccs array in the Contact\Settings valuestore
     * 
     * @param $index
     * @return void
     */
    public function deleteEmailCc($index)
    {
        $this->deleteFromEmailArray('emailCcs', $index);
    }

    /**
     * Deletes the email at the specified index from the email bccs array in the Contact\Settings valuestore
     * 
     * @param $index
     * @return void
     */
    public function deleteEmailBcc($index)
    {
        $this->deleteFromEmailArray('emailBccs', $index);
    }

    /**
     * HELPER METHODS
     */

    /**
     * Deletes an item from an array (identified by key) in the Settings valuestore at a particular index.
     * If the index is not in the array, or if the value at that key does not exist or is not an array, does nothing.
     *
     * @param  string  $key
     * @param  int  $index
     * @return void
     */
    protected function deleteFromEmailArray(string $key, int $index)
    {
        $storedEmails = $this->settings->get($key);

        if (is_array($storedEmails) && count($storedEmails) > $index) {
            array_splice($storedEmails, $index, 1);
            $this->settings->put($key, $storedEmails);
        }
    }

    /**
     * Pushes a value to an array (identified by key) in the Settings valuestore.
     * If no value exists for that key, creates the array with that value in it and saves it in the Settings valuestore.
     *
     * @param  string  $key
     * @param  string  $value
     * @return void
     */
    protected function storeToEmailArray(string $key, string $value)
    {
        $storedEmails = $this->settings->get($key);

        // Initializes empty array in the case when the key does not exist.
        if (empty($storedEmails)) {
            $storedEmails = [];
        }

        $storedEmails[] = $value;

        $this->settings->put($key, $storedEmails);
    }
}
