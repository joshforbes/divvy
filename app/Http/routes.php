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

//Event::listen('illuminate.query', function($sql)
//{
//	var_dump($sql);
//});

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

#Projects
Route::post('/p', ['as' => 'project.store', 'uses' => 'ProjectsController@store']);
Route::get('/p/create', ['as' => 'project.create', 'uses' => 'ProjectsController@create']);
Route::post('/p/{id}/addUser', ['as' => 'project.addUser', 'uses' => 'ProjectsController@addUser']);
Route::get('/p/{id}', ['as' => 'project.show', 'uses' => 'ProjectsController@show']);

#Tasks
Route::post('/p/{id}/task', ['as' => 'task.store', 'uses' => 'TasksController@store']);
Route::get('/p/{id}/task/create', ['as' => 'task.create', 'uses' => 'TasksController@create']);
Route::get('/p/{projectId}/task/{taskId}', ['as' => 'task.show', 'uses' => 'TasksController@show']);
Route::get('/p/{projectId}/task/{taskId}/edit', ['as' => 'task.edit', 'uses' => 'TasksController@edit']);
Route::patch('/p/{projectId}/task/{taskId}', ['as' => 'task.update', 'uses' => 'TasksController@update']);


#Subtasks
Route::post('/p/{projectId}/task/{taskId}', ['as' => 'subtask.store', 'uses' => 'SubtasksController@store']);
Route::get('/p/{projectId}/task/{taskId}/subtask/{subtaskId}', ['as' => 'subtask.show', 'uses' => 'SubtasksController@show']);
Route::patch('/p/{projectId}/task/{taskId}/subtask/{subtaskId}', ['as' => 'subtask.update', 'uses' => 'SubtasksController@update']);
Route::delete('/p/{projectId}/task/{taskId}/subtask/{subtaskId}', ['as' => 'subtask.destroy', 'uses' => 'SubtasksController@destroy']);
Route::post('/p/{projectId}/task/{taskId}/subtask/{subtaskId}/complete', ['as' => 'subtask.complete', 'uses' => 'SubtasksController@complete']);
Route::post('/p/{projectId}/task/{taskId}/subtask/{subtaskId}/notComplete', ['as' => 'subtask.notComplete', 'uses' => 'SubtasksController@notComplete']);

#Discussions
Route::post('/p/{projectId}/task/{taskId}/discussion', ['as' => 'discussion.store', 'uses' => 'DiscussionsController@store']);
Route::get('/p/{projectId}/task/{taskId}/discussion/{discussionId}', ['as' => 'discussion.show', 'uses' => 'DiscussionsController@show']);
Route::delete('/p/{projectId}/task/{taskId}/discussion/{discussionId}', ['as' => 'discussion.destroy', 'uses' => 'DiscussionsController@destroy']);


#Comments
Route::post('/comment/discussion/{discussionId}', ['as' => 'comment.storeDiscussion', 'uses' => 'DiscussionsController@storeComment']);
Route::post('/comment/subtask/{subtaskId}', ['as' => 'comment.storeSubtask', 'uses' => 'SubtasksController@storeComment']);

#Profiles
Route::get('/{username}/edit', [
	'as' => 'profile.edit',
	'uses' => 'ProfilesController@edit',
	'middleware' => 'profile.owner'
]);
Route::patch('/{username}', ['as' => 'profile.update', 'uses' => 'ProfilesController@update']);
Route::patch('/{username}/upload', ['as' => 'profile.uploadAvatar', 'uses' => 'ProfilesController@uploadAvatar']);
Route::get('/{username}', ['as' => 'profile.show', 'uses' => 'ProfilesController@show']);

