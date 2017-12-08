<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class EditTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
//        $this->withoutExceptionHandling();
    }

    /**
     * EditTask.
     *
     * @test
     */
    public function edit_a_task()
    {
        $command = Mockery::mock('App\Console\Commands\EditTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('New task name?')
            ->andReturn('NewName');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        $task = Task::create([
            'name'        => 'ProvaEdit',
            'description' => 'ProvaEdit',
            'user_id'     => 1,
        ]);

        $this->artisan('task:edit', ['id' => 1]);

        $response = Artisan::output();

        $this->assertContains('Task edited successfully', $response);

        $this->assertDatabaseHas('tasks', [
            'id'   => $task->id,
            'name' => 'NewName',
        ]);
    }

    /**
     * EditTask.
     *
     * @test
     */
    public function edit_a_task_and_not_found()
    {
        $this->artisan('task:edit', ['id' => 1]);

        $response = Artisan::output();

        $this->assertContains('Task with id 1 not found', $response);
    }

    /**
     * EditTask.
     *
     * @test
     */
    public function edit_ask_for_task_and_edit()
    {
        $command = Mockery::mock('App\Console\Commands\EditTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task id?')
            ->andReturn(1);

        $command->shouldReceive('ask')
            ->once()
            ->with('New task name?')
            ->andReturn('NewName');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        $task = Task::create([
            'name'        => 'ProvaEdit',
            'description' => 'ProvaEdit',
            'user_id'     => 1,
        ]);

        $this->artisan('task:edit');

        $response = Artisan::output();

        $this->assertContains('Task edited successfully', $response);

        $this->assertDatabaseHas('tasks', [
            'id'   => $task->id,
            'name' => 'NewName',
        ]);
    }

    /**
     * EditTask.
     *
     * @test
     */
    public function edit_ask_for_task_and_not_found()
    {
        $command = Mockery::mock('App\Console\Commands\EditTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task id?')
            ->andReturn(1);

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        $this->artisan('task:edit');

        $response = Artisan::output();

        $this->assertContains('Task with id 1 not found', $response);
    }
}
