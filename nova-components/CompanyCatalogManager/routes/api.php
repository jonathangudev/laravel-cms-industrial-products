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

Route::get('/{id}/categories', 'CategoryController@getCategories');
Route::put('/{id}/categories', 'CategoryController@updateCategories');
Route::delete('/category/{id}', 'CategoryController@deleteCategory');
