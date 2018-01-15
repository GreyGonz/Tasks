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
});
