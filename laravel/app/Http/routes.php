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

Route::get('/', 'WelcomeController@index');
Route::get('/game', 'GameController@index');
Route::get('/getscore', 'GameController@getScore');
Route::post('/postscore', 'GameController@postScore');

Route::get('/profile', 'ProfileController@index');

Route::get('/shop', 'ShopController@index');
Route::patch('/shop', 'ShopController@buy');

