<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskDescription;
use App\Task;
use Illuminate\Http\Request;

class ApiTaskDescriptionController extends Controller
{

    public function update(UpdateTaskDescription $request, Task $task) {

        $task->description = $request->description;
        $task->save();

        return $task;
    }
}
