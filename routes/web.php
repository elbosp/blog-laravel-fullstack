<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('datatables/vue', function () {
    return view('datatables.vue');
});

Route::middleware('auth')->name('web.')->group(function ()
{
    Route::namespace('product')->group(function ()
    {
        Route::resource('product', 'WebController');
        Route::prefix('web/api')->name('api.')->group(function ()
        {
            Route::resource('product', 'ApiController');
            Route::get('product-shuffle', 'ProductController@shuffle')->name('product-shuffle');
            Route::get('product-random', 'ProductController@random')->name('product-random');
            Route::get('product-custom', 'ProductController@custom')->name('product-custom');
            Route::get('product-pluck', 'ProductController@pluck')->name('product-pluck');
            Route::get('product-count', 'ProductController@count')->name('product-count');
            Route::get('product-when', 'ProductController@when')->name('product-when');
            Route::get('product-sum', 'ProductController@sum')->name('product-sum');
            Route::get('product-tap', 'ProductController@tap')->name('product-tap');
        });
    });
});
