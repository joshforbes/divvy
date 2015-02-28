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

Route::get('/database', function() {
	var_dump(\App\User::all()->toArray());
});

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

#Projects
Route::post('/p', ['as' => 'project.store', 'uses' => 'ProjectsController@store']);
Route::post('/p/{id}/addUser', ['as' => 'project.addUser', 'uses' => 'ProjectsController@addUser']);
Route::get('/p/{id}', ['as' => 'project.show', 'uses' => 'ProjectsController@show']);

#Tasks
Route::post('/p/{id}/task', ['as' => 'task.store', 'uses' => 'TasksController@store']);
Route::get('/p/{id}/task/create', ['as' => 'task.create', 'uses' => 'TasksController@create']);
Route::get('/p/{projectId}/task/{taskId}', ['as' => 'task.show', 'uses' => 'TasksController@show']);

#Profiles
Route::get('/{username}/edit', [
	'as' => 'profile.edit',
	'uses' => 'ProfilesController@edit',
	'middleware' => 'profile.owner'
]);
Route::patch('/{username}', ['as' => 'profile.update', 'uses' => 'ProfilesController@update']);
Route::patch('/{username}/upload', ['as' => 'profile.uploadAvatar', 'uses' => 'ProfilesController@uploadAvatar']);
Route::get('/{username}', ['as' => 'profile.show', 'uses' => 'ProfilesController@show']);

