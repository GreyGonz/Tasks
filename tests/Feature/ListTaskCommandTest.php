<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ListTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ListTask.
     *
     * @test
     */
    public function list_all_tasks()
    {

        // prepare

        factory(Task::class, 10)->create();

        $tasks = Task::all();

        // run

        $this->artisan('task:list');

        $response = Artisan::output();

        foreach ($tasks as $task) {
            $this->assertContains($task->name, $response);
        }

        $this->assertContains('10 tasks shown', $response);
    }

    /**
     * ListTask.
     *
     * @test
     */
    public function list_tasks_not_found()
    {
        $this->artisan('task:list');

        $response = Artisan::output();

        $this->assertContains('There are no tasks to show', $response);
    }
}
