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

Route::get('/test', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@test');

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
Route::delete('/email-cc/{index}', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@deleteEmailCc');
Route::delete('/email-bcc/{index}', '\Jmp\ContactSettingsManager\Http\Controllers\ContactSettingsManagerController@deleteEmailBcc');
