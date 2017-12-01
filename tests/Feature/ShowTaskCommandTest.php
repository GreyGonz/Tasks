<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
     * ShowTask
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
     * ShowTask
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
     * ShowTask
     * @test
     */
    public function show_a_task_but_not_found()
    {
        $this->artisan('task:show', ['name' => 'ProvaShow']);

        $response = Artisan::output();

        $this->assertContains('Task ProvaShow not found', $response);
    }
}
