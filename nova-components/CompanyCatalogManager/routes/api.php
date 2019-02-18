<?php

use App\Company;
use Illuminate\Http\Request;
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

Route::get('/{id}/categories', function (Request $request) {
    $company = Company::find($request->route('id'));
    $categories = $company->categories;
    $category = $categories->first();

    return response()->json($category->get()->toTree());
});
