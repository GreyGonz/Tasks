<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class DeleteTaskCommandTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItDeletesTask()
    {

        // prepare

        Task::create(['name' => 'Hola']);

        // run

        $this->artisan('task:delete', ['name' => 'Hola']);

        // assert

        $resultAsText = Artisan::output();

        $this->assertContains('Task deleted succesfully', $resultAsText);

        $this->assertDatabaseMissing('tasks', [
            'name' => 'Hola',
        ]);
    }

    public function testItDeletesTaskAndThenAsksForTaskName()
    {

        // prepare

        $command = Mockery::mock('App\Console\Commands\DeleteTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task name?')
            ->andReturn('Hola');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        Task::create(['name' => 'Hola']);
        Task::create(['name' => 'Hola']);

        // run

        $this->artisan('task:delete');

        // assert

        $resultAsText = Artisan::output();

        $this->assertContains('Task deleted succesfully', $resultAsText);

        $this->assertDatabaseMissing('tasks', [
            'name' => 'Hola',
        ]);
    }

    public function testItDeletesTaskAndShowError()
    {
        $command = Mockery::mock('App\Console\Commands\DeleteTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task name?')
            ->andReturn('NotExist');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // run

        $this->artisan('task:delete');

        // assert

        $resultAsText = Artisan::output();

        $this->assertContains("Task specified don't exist", $resultAsText);
    }
}
