<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class DeleteTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * DeleteTask.
     *
     * @test
     */
    public function delete_task()
    {

        // prepare

        $task = Task::create([
            'name'        => 'ProvaDelete',
            'description' => 'ProvaDelete',
            'completed'   => false,
            'user_id'     => 1,
        ]);

        // run

        $this->artisan('task:delete', ['id' => $task->id]);

        // assert

        $resultAsText = Artisan::output();

        $this->assertContains('TaskResource deleted succesfully', $resultAsText);

        $this->assertDatabaseMissing('tasks', [
            'name' => 'ProvaDelete',
        ]);
    }

    /**
     * DeleteTask.
     *
     * @test
     */
    public function delete_task_and_not_found()
    {
        $this->artisan('task:delete', ['id' => 1]);

        $response = Artisan::output();

        $this->assertContains('TaskResource specified don\'t exist', $response);
    }

    /**
     * DeleteTask.
     *
     * @test
     */
    public function delete_ask_for_task_and_delete()
    {

        // prepare

        $command = Mockery::mock('App\Console\Commands\DeleteTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('TaskResource id?')
            ->andReturn(1);

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        Task::create([
            'name'        => 'ProvaDelete',
            'description' => 'ProvaDelete',
            'completed'   => false,
            'user_id'     => 1,
        ]);

        // run

        $this->artisan('task:delete');

        // assert

        $resultAsText = Artisan::output();

        $this->assertContains('TaskResource deleted succesfully', $resultAsText);

        $this->assertDatabaseMissing('tasks', [
            'id'   => 1,
            'name' => 'ProvaDelte',
        ]);
    }

    /**
     * DeleteTask.
     *
     * @test
     */
    public function delete_ask_for_task_and_not_found()
    {
        $command = Mockery::mock('App\Console\Commands\DeleteTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('TaskResource id?')
            ->andReturn(1);

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // run

        $this->artisan('task:delete');

        // assert

        $resultAsText = Artisan::output();

        $this->assertContains("TaskResource specified don't exist", $resultAsText);
    }
}
