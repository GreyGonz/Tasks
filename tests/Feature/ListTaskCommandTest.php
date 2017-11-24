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
     * task:list command test.
     *
     * @return void
     */
    public function testItListATask()
    {

        // prepare

        Task::create(['name' => 'NewTask']);

        $tasks = Task::all()->toArray();

        // run

        $this->artisan('task:list');

        $responseAsText = Artisan::output();

        // assert
    }
}
