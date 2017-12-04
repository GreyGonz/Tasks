<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class CreateTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * CreateTask.
     *
     * @test
     */
    public function create_task()
    {
        // prepara

        // executa
        $this->artisan('task:create', ['name' => 'ProvaCreate']);

        // comprova
        $resultAsText = Artisan::output();

        $this->assertDatabaseHas('tasks', [
            'name' => 'ProvaCreate',
        ]);

        $this->assertContains('Task has been added to database succesfully', $resultAsText);
        $this->assertDatabaseHas('tasks', [
            'id'   => 1,
            'name' => 'ProvaCreate',
        ]);
    }

    /**
     * CreateTask.
     *
     * @test
     */
    public function create_ask_for_task_and_create()
    {
        // prepara

        $command = Mockery::mock('App\Console\Commands\CreateTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task name?')
            ->andReturn('ProvaCreate');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // executa
        $this->artisan('task:create');

        // comprova
        $resultAsText = Artisan::output();
        $this->assertContains('Task has been added to database succesfully', $resultAsText);
        $this->assertDatabaseHas('tasks', [
            'id'   => 1,
            'name' => 'ProvaCreate',
        ]);
    }
}
