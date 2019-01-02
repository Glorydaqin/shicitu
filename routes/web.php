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

Route::get('/', 'Web\IndexController@index');
Route::group(['prefix' => '{locale}', 'namespace' => 'Web', 'middleware' => ['locale']], function () {

    Route::get('/', 'IndexController@index')->middleware('cache.response:720');

    Route::get('/info/{para}', 'InfoController@index')->middleware('cache.response:1440');
    Route::get('/info/{para}/watch', 'InfoController@watch')->middleware('cache.response:180');;

    //最新
    Route::get('/movies/latest', 'FilterController@latest');
    Route::get('/movies/ratings', 'FilterController@ratings');
    Route::get('/movies/update', 'FilterController@update');

    Route::get('/filter/', 'FilterController@index');
    Route::get('/filter/genre-{genre}', 'FilterController@genre');
    Route::get('/filter/country-{country}', 'FilterController@country');
    Route::get('/filter/genre-{genre}/country-{country}', 'FilterController@genre_country');
    Route::get('/content/{slug}', 'StaticController@index');

    //search
    Route::get('/search', 'SearchController@index');

    //api
    Route::get("api/search",'ApiController@search');
    Route::get("api/aff",'ApiController@aff');
    Route::get("api/watch",'ApiController@watch');

    //cloud watch
    Route::get('cloud','StaticController@cloud');
});