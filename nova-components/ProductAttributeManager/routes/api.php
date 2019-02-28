<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/{productId}/attribute-data', 'AttributeController@getData');

Route::post('/{productId}/attribute', 'AttributeController@createAttribute');
Route::put('/attribute', 'AttributeController@updateAttribute');
Route::delete('/attribute-value/{id}', 'AttributeController@deleteAttributeValue');
