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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'poetry','namespace' => 'Api'], function () {

    Route::get("/recommend",'PoetryController@recommend');
    Route::get("/getPoetryDetail",'PoetryController@getPoetryDetail');
    Route::get("/getPoetryList",'PoetryController@getPoetryList');
    Route::get("/getAuthorList",'PoetryController@getAuthorList');
    Route::get("/getTypeList",'PoetryController@getTypeList');

});