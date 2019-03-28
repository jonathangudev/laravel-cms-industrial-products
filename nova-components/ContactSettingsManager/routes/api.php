<?php

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

/** 
 * DELETE ROUTES
*/
/*Route::delete('/email-recipient/{index}', function ($index) {

    $storedEmails = app(Settings::class)->get('emailRecipients');

    // Initializes empty array in the case when the key does not exist.
    if (empty($storedEmails)) {
        $storedEmails = [];
    }

    array_splice($storedEmails, $index, 1);

    app(Settings::class)->put('emailRecipients', $storedEmails);

    /*return response()->json($index);*/
//});

//TODO - add for cc's

/** 
 * GET ROUTES
**/
Route::get('/email-recipient', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@getEmailRecipients');
Route::get('/email-cc', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@getEmailCcs');
Route::get('/email-bcc', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@getEmailBccs');

/** 
 * POST ROUTES
**/
Route::post('/email-recipient', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@storeEmailRecipient');
Route::post('/email-cc', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@storeEmailCc');
Route::post('/email-bcc', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@storeEmailBcc');

/**
 * DELETE ROUTES
 */
Route::delete('/email-recipient/{index}', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@deleteEmailRecipient');
