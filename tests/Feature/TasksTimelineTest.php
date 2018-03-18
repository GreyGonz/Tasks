<?php

namespace Tests\Feature;

use App\Task;
use App\TaskEvent;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTimelineTest extends TestCase
{

  use RefreshDatabase;

  public function setUp()
  {
    parent::setUp();
    $this->withoutExceptionHandling();

  }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function timeline_tasks()
    {
      $user = factory(User::class)->create();

      $this->actingAs($user);
      
      $task = Task::create([
        'name' => 'New Task',
        'description' => 'prova',
        'completed' => true,
        'user_id' => $user->id
      ]);
      
      $task2 = Task::find($task->id);
      
      $task->update([
        'name' => 'Updated Task'
      ]);
      
      $task->delete();

      $response = $this->get('/tasks/timeline');

      $task_event = TaskEvent::all();

      $response->assertSuccessful();
      $response->assertViewIs('tasks.timeline');
      $response->assertViewHas('task_event', $task_event);
      $response->assertSee("User ".$user->name." created task ".$task->name." at ".$task->created_at);
      $response->assertSee("User ".$user->name." retrieved task ".$task->name);
      $response->assertSee("User ".$user->name." updated task ".$task->name);
      $response->assertSee("User ".$user->name." deleted task ".$task->name);
    }
}
