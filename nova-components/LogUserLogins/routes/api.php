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

Route::get('/user/{id}', function ($id) {
    $result = UserLogin::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);
    return response()->json($result);
});
