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

Route::middleware('auth:api')->group(function () {
    Route::get('profile', 'UserController@get');
    Route::resource('product', 'ProductController', [
        'except' => ['edit', 'create']
    ]);
});

Route::resource('hospital', 'HospitalController', [
    'except' => ['edit', 'create', 'store', 'show', 'update']
]);
