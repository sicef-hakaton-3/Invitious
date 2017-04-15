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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/tweets', ['as' => 'tweets', 'uses' => 'HomeController@getTweetsByHashTag']);
Route::get('/tweets/page', ['as' => 'tweetsPage', 'uses' => 'HomeController@twitter']);
Route::get('/getEventsByCity', ['as' => 'home', 'uses' => 'HomeController@getEventsByCity']);

Route::get('/get-city-info', ['as' => 'get-city-info', 'uses' => 'HomeController@getCityInfo']);
Route::get('/getHotelsByCity', ['as' => 'home', 'uses' => 'HomeController@getHotelsByCity']);

Route::get('/getEmployersByCity', ['as' => 'employers', 'uses' => 'HomeController@getEmployersByCity']);
Route::get('/getSchoolsByCity', ['as' => 'schools', 'uses' => 'HomeController@getSchoolsByCity']);


Route::get('/test-flight', ['as' => 'flight', 'uses' => 'HomeController@flight']);

Route::get('/cities/list', ['as' => 'citiesList', 'uses' => 'HomeController@autocomplete']);
Route::get('/compare-cities', ['as' => 'compare-cities', 'uses' => 'HomeController@compareCities']);


Route::get('/map', ['as' => 'map', 'uses' => 'HomeController@map']);

