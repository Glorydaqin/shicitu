<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/back', function () {
    return redirect("back/login");
});
//admin
Route::any("back/login","LoginController@login");
Route::get("back/logout","LoginController@logout");
Route::group(['prefix' => 'back','namespace'=>'Admin'], function () {



});