<?php

namespace Tests\Unit;

use App\Task;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskObserverTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function a_created_event_is_logged_when_task_is_created()
    {
      $user = factory(User::class)->create();
      $time = Carbon::now();
      $task = Task::create([
        'name' => 'New Task',
        'description' => 'prova',
        'completed' => true,
        'user_id' => $user->id
      ]);

      $this->assertDatabaseHas('task_events', [
          'time' => $time,
          'task_name' => $task->name,
          'user_name' => $user->name
      ]);

    }
}
