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

Route::post('/email-recipient', function (Request $request) {
    $newEmail = $request->input('email');

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

Route::delete('/email-recipient', function () {
    return response()->json();
});
