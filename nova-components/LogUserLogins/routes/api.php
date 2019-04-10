<?php

use Illuminate\Support\Facades\Route;
use App\Logs\UserLogin;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. You're free to add
| as many additional routes to this file as your tool may require.
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });

Route::get('/', function () {
    echo "hello world";
});

Route::get('/user/{id}', function ($id) {
    $result = UserLogin::where('user_id', $id)->get();
    return response()->json($result);
});
