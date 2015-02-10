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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

#Profiles
Route::get('/{username}/edit', [
	'as' => 'profile.edit',
	'uses' => 'ProfilesController@edit',
	'middleware' => 'profile.owner'
]);
Route::patch('/{username}', ['as' => 'profile.update', 'uses' => 'ProfilesController@update']);

//Route::resource('profile', 'ProfilesController', ['only' => ['show', 'edit', 'update']]);
Route::get('/{username}', ['as' => 'profile.show', 'uses' => 'ProfilesController@show']);
