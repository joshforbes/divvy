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
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function ()
{
    #Projects
    Route::post('/p', ['as' => 'project.store', 'uses' => 'ProjectsController@store']);
    Route::get('/p/create', ['as' => 'project.create', 'uses' => 'ProjectsController@create']);

    #Project Admin Routes
    Route::group(['middleware' => 'project.admin'], function ()
    {
        #Projects
        Route::get('/p/{projectId}/edit', ['as' => 'project.edit', 'uses' => 'ProjectsController@edit']);
        Route::patch('p/{projectId}', ['as' => 'project.update', 'uses' => 'ProjectsController@update']);
        Route::post('/p/{projectId}/addUser', ['as' => 'project.addUser', 'uses' => 'ProjectsController@addUser']);
        Route::delete('/p/{projectId}/removeUser/{userId}', ['as' => 'project.removeUser', 'uses' => 'ProjectsController@removeUser']);
        Route::delete('/p/{projectId}/destroy', ['as' => 'project.destroy', 'uses' => 'ProjectsController@destroy']);

        #Activity
        Route::get('/p/{projectId}/activity', ['as' => 'activity.index', 'uses' => 'ActivityController@index']);

        #Tasks
        Route::post('/p/{projectId}/task', ['as' => 'task.store', 'uses' => 'TasksController@store']);
        Route::get('/p/{projectId}/task/create', ['as' => 'task.create', 'uses' => 'TasksController@create']);
        Route::get('/p/{projectId}/task/{taskId}/edit', ['as' => 'task.edit', 'uses' => 'TasksController@edit']);
        Route::patch('/p/{projectId}/task/{taskId}', ['as' => 'task.update', 'uses' => 'TasksController@update']);
        Route::delete('/p/{projectId}/task/{taskId}', ['as' => 'task.destroy', 'uses' => 'TasksController@destroy']);
        Route::post('/p/{projectId}/task/{taskId}/complete', ['as' => 'task.complete', 'uses' => 'TasksController@complete']);
        Route::post('/p/{projectId}/task/{taskId}/incomplete', ['as' => 'task.incomplete', 'uses' => 'TasksController@incomplete']);
    });

    #Project Member Routes
    Route::group(['middleware' => ['project.member']], function ()
    {
        #Projects
        Route::get('/p/{projectId}', ['as' => 'project.show', 'uses' => 'ProjectsController@show']);

        #User Activity
        Route::get('/p/{projectId}/activity/{username}', ['as' => 'activity.showProject', 'uses' => 'ActivityController@showProject']);

        Route::group(['middleware' => 'task.assigned'], function ()
        {
            #Tasks
            Route::get('/p/{projectId}/task/{taskId}', ['as' => 'task.show', 'uses' => 'TasksController@show']);

            #Activity
            Route::get('/p/{projectId}/task/{taskId}/activity', ['as' => 'activity.taskIndex', 'uses' => 'ActivityController@taskIndex']);
            Route::get('/p/{projectId}/task/{taskId}/activity/{username}', ['as' => 'activity.showTask', 'uses' => 'ActivityController@showTask']);

            #Subtasks
            Route::post('/p/{projectId}/task/{taskId}', ['as' => 'subtask.store', 'uses' => 'SubtasksController@store']);
            Route::get('/p/{projectId}/task/{taskId}/subtask/{subtaskId}', ['as' => 'subtask.show', 'uses' => 'SubtasksController@show']);
            Route::patch('/p/{projectId}/task/{taskId}/subtask/{subtaskId}', ['as' => 'subtask.update', 'uses' => 'SubtasksController@update']);
            Route::delete('/p/{projectId}/task/{taskId}/subtask/{subtaskId}', ['as' => 'subtask.destroy', 'uses' => 'SubtasksController@destroy']);
            Route::post('/p/{projectId}/task/{taskId}/subtask/{subtaskId}/complete', ['as' => 'subtask.complete', 'uses' => 'SubtasksController@complete']);
            Route::post('/p/{projectId}/task/{taskId}/subtask/{subtaskId}/incomplete', ['as' => 'subtask.incomplete', 'uses' => 'SubtasksController@incomplete']);

            #Discussions
            Route::post('/p/{projectId}/task/{taskId}/discussion', ['as' => 'discussion.store', 'uses' => 'DiscussionsController@store']);
            Route::get('/p/{projectId}/task/{taskId}/discussion/{discussionId}', ['as' => 'discussion.show', 'uses' => 'DiscussionsController@show']);
            Route::group(['middleware' => 'discussion.author'], function ()
            {
                Route::patch('/p/{projectId}/task/{taskId}/discussion/{discussionId}', ['as' => 'discussion.update', 'uses' => 'DiscussionsController@update']);
                Route::delete('/p/{projectId}/task/{taskId}/discussion/{discussionId}', ['as' => 'discussion.destroy', 'uses' => 'DiscussionsController@destroy']);
            });

            #Comments
            Route::post('/p/{projectId}/task/{taskId}/discussion/{discussionId}/comment', ['as' => 'comment.storeDiscussion', 'uses' => 'DiscussionsController@storeComment']);
            Route::post('/p/{projectId}/task/{taskId}/subtask/{subtaskId}/comment', ['as' => 'comment.storeSubtask', 'uses' => 'SubtasksController@storeComment']);
            Route::group(['middleware' => 'comment.author'], function ()
            {
                Route::delete('/p/{projectId}/task/{taskId}/comment/{commentId}', ['as' => 'comment.destroy', 'uses' => 'CommentsController@destroy']);
                Route::patch('/p/{projectId}/task/{taskId}/comment/{commentId}', ['as' => 'comment.update', 'uses' => 'CommentsController@update']);
            });
        });

    });
});

Route::group(['middleware' => 'owner'], function ()
{
    #Notifications
    Route::get('/{username}/notifications', ['as' => 'notification.index', 'uses' => 'NotificationsController@index']);
    Route::get('/{username}/notifications/read', ['as' => 'notification.markAsRead', 'uses' => 'NotificationsController@markAsRead']);

    #Profiles
    Route::get('/{username}/edit', ['as' => 'profile.edit', 'uses' => 'ProfilesController@edit']);
    Route::patch('/{username}', ['as' => 'profile.update', 'uses' => 'ProfilesController@update']);
    Route::patch('/{username}/upload', ['as' => 'profile.uploadAvatar', 'uses' => 'ProfilesController@uploadAvatar']);
});

#Profiles
Route::get('/{username}', ['as' => 'profile.show', 'uses' => 'ProfilesController@show']);
