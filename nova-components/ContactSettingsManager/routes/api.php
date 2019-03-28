<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Contact\Settings;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/endpoint', function () {
        //$this->app(Settings::class)->put('emailRecipients', $request['emailRecipient']);
    ;
    return response()->json();
});

/** 
 * POST ROUTES
*/
Route::post('/email-recipient', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|email',
    ]);

    $newEmail = $validated['email'];

    app(Settings::class)->storeToArray('emailRecipients', $newEmail);

    $result = app(Settings::class)->get('emailRecipients');

    return response()->json($result);
});

Route::post('/email-cc', function () {
    return response()->json();
});

Route::post('/email-bcc', function () {
    return response()->json();
});

/** 
 * DELETE ROUTES
*/
Route::delete('/email-recipient/{index}', function ($index) {

    $storedEmails = app(Settings::class)->get('emailRecipients');

    // Initializes empty array in the case when the key does not exist.
    if (empty($storedEmails)) {
        $storedEmails = [];
    }

    array_splice($storedEmails, $index, 1);

    app(Settings::class)->put('emailRecipients', $storedEmails);

    /*return response()->json($index);*/
});

//TODO - add for cc's

/** 
 * GET ROUTES
*/
Route::get('/email-recipient', function () {
    $result = app(Settings::class)->get('emailRecipients');

    return response()->json($result);
});

//TODO - add for bcc's
