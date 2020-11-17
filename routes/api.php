<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController')->name('login');
    });

    Route::group(['prefix' => 'matrix', 'middleware' => 'auth:api'], function () {
        Route::get('GetAccountUsers', 'ClientController@getAccountUsers');
        Route::get('GetAccountDiscountsByPhone', 'ClientController@getAccountDiscountsByPhone');
        Route::get('GetAccountDiscounts', 'ClientController@getAccountDiscounts');

        Route::get('GetExpiringDiscounts', 'DiscountController@getExpiringDiscounts');
        Route::get('GetAllDiscounts', 'DiscountController@getAllDiscounts');
    });
});
