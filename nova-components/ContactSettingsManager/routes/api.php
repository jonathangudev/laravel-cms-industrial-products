<?php

use Illuminate\Support\Facades\Route;

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
 * GET ROUTES
**/
Route::get('/email-recipient', 'ContactSettingsManagerController@getEmailRecipients');
Route::get('/email-cc', 'ContactSettingsManagerController@getEmailCcs');
Route::get('/email-bcc', 'ContactSettingsManagerController@getEmailBccs');

/** 
 * POST ROUTES
**/
Route::post('/email-recipient', 'ContactSettingsManagerController@storeEmailRecipient');
Route::post('/email-cc', 'ContactSettingsManagerController@storeEmailCc');
Route::post('/email-bcc', 'ContactSettingsManagerController@storeEmailBcc');

/**
 * DELETE ROUTES
 */
Route::delete('/email-recipient/{index}', 'ContactSettingsManagerController@deleteEmailRecipient');
Route::delete('/email-cc/{index}', 'ContactSettingsManagerController@deleteEmailCc');
Route::delete('/email-bcc/{index}', 'ContactSettingsManagerController@deleteEmailBcc');
