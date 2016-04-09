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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/game', 'GameController@index');

Route::get('/profile', 'ProfileController@index');

Route::get('/shop', 'ShopController@index');

Route::patch('/shop', 'ShopController@buy');

//Route::group()