<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyTask;
use App\Http\Requests\ListTask;
use App\Http\Requests\ShowTask;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use App\Task;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use Illuminate\Http\Request;

class ApiTaskController extends Controller
{
    public function index(ListTask $request)
    {
        return new TaskCollection(Task::all());
    }

    public function show(ShowTask $request, Task $task)
    {
        return new TaskResource($task);
    }

    public function store(StoreTask $request)
    {
        $task = Task::create([
            'name'        => $request->name,
            'description' => $request->description,
            'completed'   => $request->completed,
        ]);

        return $task;
    }

    /**
     * Delete.
     *
     * @param Request $request
     * @param Task    $task
     */
    public function destroy(DestroyTask $request, Task $task)
    {
        $task->delete();

        return $task;
    }

    /**
     * Update.
     *
     * @param Request $request
     * @param Task    $task
     */
    public function update(UpdateTask $request, Task $task)
    {
        $task->name = $request->name;
        $task->description = $request->description;
        $task->save();

        return $task;
    }
}
