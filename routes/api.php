<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'middleware' => ['throttle', 'bindings']], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/tasks', 'ApiTaskController@index');
        Route::post('/tasks', 'ApiTaskController@store');
        Route::get('/tasks/{task}', 'ApiTaskController@show');
        Route::delete('/tasks/{task}', 'ApiTaskController@destroy');
        Route::put('/tasks/{task}', 'ApiTaskController@update');

        Route::get('/v1/users', 'ApiUserTaskController@index');
        Route::post('/v1/users', 'ApiUserTaskController@store');
        Route::get('/v1/users/{user}', 'ApiUserTaskController@show');
        Route::delete('/v1/users/{user}', 'ApiUserTaskController@destroy');
        Route::put('/v1/users/{user}', 'ApiUserTaskController@update');

        Route::put('/v1/tasks/{task}/description', 'ApiTaskDescriptionController@update');

        Route::post('/v1/completed-tasks/{task}', 'ApiCompletedTaskController@store');
        Route::delete('/v1/completed-tasks/{task}', 'ApiCompletedTaskController@destroy');
    });
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    //adminlte_api_routes
});
