<?php

namespace App\Observer;

use App\Task;
use App\TaskEvent;
use Carbon\Carbon;

class TaskObserver {

  public function created(Task $task)
  {
    TaskEvent::create([
      'time' => Carbon::now(),
      'type' => 'created',
      'task_name' => $task->name,
      'user_name' => $task->user->name
    ]);
  }

  public function updated(Task $task)
  {
    TaskEvent::create([
      'time' => Carbon::now(),
      'type' => 'updated',
      'task_name' => $task->name,
      'user_name' => $task->user->name,
    ]);
  }

  public function retrieved(Task $task) {
    TaskEvent::create([
      'time' => Carbon::now(),
      'type' => 'retrieved',
      'task_name' => $task->name,
      'user_name' => $task->user->name,
    ]);
  }

  public function deleted(Task $task)
  {
    TaskEvent::create([
      'time' => Carbon::now(),
      'type' => 'deleted',
      'task_name' => $task->name,
      'user_name' => $task->user->name,
    ]);
  }
}