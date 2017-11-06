<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;

class ApiTaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $task = Task::create([
            'name' => $request->name
        ]);

        return $task;
    }

    /**
     * Delete
     * @param Request $request
     * @param Task $task
     */
    public function destroy(Request $request, Task $task) {

        $task->delete();

        return $task;
    }

    /**
     * Update
     * @param Request $request
     * @param Task $task
     */
    public function update(Request $request, Task $task) {
        $request->validate([
            'name' => 'required'
        ]);

        $task->name = $request->name;
        $task->save();

        return $task;
    }
}