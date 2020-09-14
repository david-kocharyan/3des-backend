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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['namespace' => 'Api', "prefix" => "v1"], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::post('sign-up', 'AuthController@signup');
        Route::post('sign-in', 'AuthController@login');

        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('get-user', 'AuthController@user');
            Route::get('get-partner', 'AuthController@partner');
        });
    });

    Route::group(['prefix' => 'reset'], function () {
        Route::post('send-mail', 'PasswordReset@getMail');
        Route::post('password', 'PasswordReset@changePassword');
    });

    Route::post('contact-store', 'ContactController@store');
    Route::post('subscriber-store', 'SubscribeController@store');
    Route::get('faq-get', 'FaqController@index');
    Route::get('video-get', 'VideoController@index');
});
