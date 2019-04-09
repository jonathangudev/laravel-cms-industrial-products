<?php

use App\Pages\HomePage;
use App\Pages\AboutUsPage;
use App\Pages\ProductsAndServices\Row;

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
    return view('home', ['homePage' => HomePage::first()]);
})->name('home');

Route::get('/about', function () {
    return view('about', ['aboutUs' => AboutUsPage::first()]);
})->name('about');

Route::get('/products-and-services', function () {
    return view('products-services', ['pageRows' => Row::with(['contents'])->orderBy('sort_order', 'asc')->get()]);
})->name('products-services');

// Contact Form Routes...
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', 'ContactController@submitContact');
Route::post('/contact/footer', 'ContactController@submitContactFooter')->name('contact.footer');

// Thank You Routes
// For Contact Page form
Route::get('/thank-you', function () {
    return view('thank-you');
})->name('thank-you');

// For footer form
Route::get('/thank-you/footer', function () {
    return view('thank-you');
})->name('thank-you.footer');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Catalog Routes...
Route::get('/catalog', 'CatalogController@index')->name('catalog');
Route::get('/catalog/{id}', 'CatalogController@getCategory')->name('catalog.category');
Route::get('catalog/asset/fake/{path?}', function ($path) {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'https://placekitten.com/' . $path);
    return $res->getBody();
})->where(['path' => '.*']);
Route::get('catalog/asset/{company}/{path?}', 'RestrictedAssetController@getAsset')->where(['path' => '.*']);

// Email Preview Routes
Route::get(
    env('APP_BACKEND_PATH', '/nova') . '/emails/preview/welcome-user',
    'EmailPreviewController@getUserWelcomePreview'
);

Route::post('/search', 'CatalogSearchController@search')->name('search');
