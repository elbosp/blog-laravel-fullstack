<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->name('api.')->group(function ()
{
    Route::namespace('product')->group(function ()
    {
        Route::resource('product', 'ApiController');
    });
});

Route::resource('hospital', 'HospitalController', [
    'only' => ['index', 'destroy']
]);
