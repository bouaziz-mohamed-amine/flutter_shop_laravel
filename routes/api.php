<?php

use Illuminate\Http\Request;

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
//Route::get('products/categories/{id}', 'Api\CategoryController@showProducts')->middleware('check_age:14');
//Route::middleware('auth:api')->get('products/categories/{id}', 'Api\CategoryController@showProducts');

//**************   Auth register **************** //
Route::post('auth/register', 'Api\AuthController@register');
//****************middleware*****************////
Route::group(['middleware' => ['auth:api']], function () {
    //********************************* Auth ********************************************/////
    Route::get('auth/logout', 'Api\AuthController@logout');
    ///////*********    products routes     *********//////////
    Route::apiResource('products', 'Api\ProductController');
    ///////*********   categories routes    *********//////////
    Route::apiResource('categories', 'Api\CategoryController');
    //Route::get('products/categories/{id}', 'Api\CategoryController@showProducts');
});

