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
     * Create task test.
     *
     * @return void
     */
    public function testItCreatesNewTask()
    {
        // prepara

        // executa
        $this->artisan('task:create', ['name' => 'Compra pa']);

        // comprova
        $resultAsText = Artisan::output();

        $this->assertDatabaseHas('tasks', [
            'name' => 'Compra pa',
        ]);

        $this->assertContains('Task has been added to database succesfully', $resultAsText);
    }

    public function testItAsksForATaskNameAndThenCreateNewTask2()
    {
        // prepara

        $command = Mockery::mock('App\Console\Commands\CreateTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task name?')
            ->andReturn('Comprar alguna cosa');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // executa
        $this->artisan('task:create');

        // comprova
        $resultAsText = Artisan::output();
        $this->assertContains('Task has been added to database succesfully', $resultAsText);
    }
}
