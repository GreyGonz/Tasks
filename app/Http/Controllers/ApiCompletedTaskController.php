<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyCompletedTask;
use App\Http\Requests\StoreCompletedTask;
use App\Http\Resources\TaskResource;
use App\Task;
use Illuminate\Http\Request;

class ApiCompletedTaskController extends Controller
{
    public function store(StoreCompletedTask $request, Task $task) {

        $task->completed = true;
        $task->save();

        return new TaskResource($task);
    }

    public function destroy(DestroyCompletedTask $request, Task $task) {

        $task->completed = false;
        $task->save();

        return new TaskResource($task);
    }
}
