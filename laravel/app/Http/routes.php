<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/game', 'GameController@index');
Route::post('/game', 'GameController@postChanges');
Route::get('/getdata', 'GameController@getData');


Route::get('/profile', 'ProfileController@index');
Route::get('/profile/passchange', 'ProfileController@passView');
Route::get('/profile/skins', 'ProfileController@skins');
Route::patch('/profile/skins', 'ProfileController@changeSkin');

Route::get('/shop', 'ShopController@index');
Route::patch('/shop', 'ShopController@buy');
