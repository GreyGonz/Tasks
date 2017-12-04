<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class ShowTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
//        $this->withoutExceptionHandling();
    }

    /**
     * ShowTask.
     *
     * @test
     */
    public function show_a_task()
    {
        $task = Task::create(['name'=> 'ProvaShow']);

        $this->artisan('task:show', ['name' => 'ProvaShow']);

        $response = Artisan::output();

        $this->assertContains('Tasks shown', $response);
        $this->assertContains('ProvaShow', $response);
    }

    /**
     * ShowTask.
     *
     * @test
     */
    public function show_multiple_tasks_with_same_name()
    {
        Task::create(['name' => 'ProvaShow']);
        Task::create(['name' => 'ProvaShow']);

        $this->artisan('task:show', ['name' => 'ProvaShow']);

        $response = Artisan::output();

        $this->assertContains('2 Tasks shown', $response);
        $this->assertContains('ProvaShow', $response);
        $this->assertContains('1', $response);
        $this->assertContains('2', $response);
    }

    /**
     * ShowTask.
     *
     * @test
     */
    public function show_a_task_but_not_found()
    {
        $this->artisan('task:show', ['name' => 'ProvaShow']);

        $response = Artisan::output();

        $this->assertContains('Task ProvaShow not found', $response);
    }

    /**
     * ShowTask.
     *
     * @test
     */
    public function show_ask_for_task_and_show()
    {
        $command = Mockery::mock('App\Console\Commands\ShowTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task name?')
            ->andReturn('ProvaShow');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        Task::create(['name' => 'ProvaShow']);

        $this->artisan('task:show');

        $response = Artisan::output();

        $this->assertContains('Tasks shown', $response);
        $this->assertContains('ProvaShow', $response);
    }

    /**
     * ShowTask.
     *
     * @test
     */
    public function show_ask_for_task_and_not_found()
    {
        $command = Mockery::mock('App\Console\Commands\ShowTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task name?')
            ->andReturn('NoExist');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        $this->artisan('task:show');

        $response = Artisan::output();

        $this->assertNotContains('Task shown', $response);
        $this->assertContains('Task NoExist not found', $response);
    }
}