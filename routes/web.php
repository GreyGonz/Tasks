<?php

use App\Mail\Hello;
use Illuminate\Support\Facades\Mail;
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

Route::group(['middleware' => 'auth'], function () {
//    Route::resource('/tasks', 'TaskController');

    Route::view('/tasks_component', 'taskscomponent');
    Route::view('/tasks_container', 'tasks_api/tasksContainer');

    Route::get('tasks/timeline', 'TasksTimelineController@index');
  /*Route::get('/send_mail', function () {
        $user = 'App\User'::find(1);
        $mail = new Hello($user);
        Mail::to($user)->send($mail);
    });
 */
    Route::get('/mail',         'MailController@index');
    Route::post('/send_mail',    'MailController@store');
    // PROVES
    Route::view('/proves', 'proves');
});
