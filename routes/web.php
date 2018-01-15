<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/tasks', 'TaskController');

    Route::view('/tasks_component', 'taskscomponent');
    Route::view('/tasks_container', 'tasks_api/tasksContainer');

    // PROVES
    Route::view('/proves', 'proves');
    Route::get('tasca',function() {
        return new \App\Http\Resources\TaskResource(App\Task::find(1));
    });

    Route::get('tasca1',function() {
        return App\Task::find(1);
    });

    Route::get('tascas',function() {
        return \App\Http\Resources\TaskResource::collection(App\Task::all());
    });
});
