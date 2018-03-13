<?php

namespace App\Http\Controllers;

use App\TaskEvent;
use Illuminate\Http\Request;

class TasksTimelineController extends Controller
{
  public function index()
  {
    $task_events = TaskEvent::all();
    return view('tasks.timeline', ['task_events' => $task_events->reverse()]);
  }
}
