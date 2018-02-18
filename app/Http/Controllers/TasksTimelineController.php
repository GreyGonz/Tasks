<?php

namespace App\Http\Controllers;

use App\TaskEvent;
use Illuminate\Http\Request;

class TasksTimelineController extends Controller
{
  public function index()
  {
    $task_event = TaskEvent::all();
    return view('tasks.timeline', ['task_event' => $task_event]);
  }
}
