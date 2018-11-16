<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/products-and-services', function () {
    return view('products-services');
})->name('products-services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/categories', function () {
    return view('categories');
})->name('categories');
