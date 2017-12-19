<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class APIAttendedTaskControllerTest.
 *
 * @package Tests\Feature
 */
class APICompletedTaskControllerTest extends TestCase
{
    use RefreshDatabase;

    const MANAGER = 'task-manager';

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
//        $this->withoutExceptionHandling();
    }

    /**
     * Login as tasks manager.
     *
     * @param $user
     */
    protected function loginAsManager($user, $driver = 'api')
    {
        $user->assignRole(self::MANAGER);
        $this->actingAs($user,$driver);
    }

    /**
     * Store completed task.
     *
     * @test
     */
    public function store_completed_task()
    {
        $user = factory(User::class)->create();
        $this->loginAsManager($user,'api');
        $task = factory(Task::class)->create([
            'completed' => false,
        ]);

        $response = $this->json('POST', '/api/v1/completed-tasks/' . $task->id);

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'completed' => true,
            'user_id' => $task->user_id,
        ]);

        $response->assertJson([
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'completed' => true,
            'user_id' => $task->user_id,
        ]);
    }

    /**
     * Destroy completed task.
     *
     * @test
     */
    public function destroy_completed_task()
    {
        $user = factory(User::class)->create();
        $this->loginAsManager($user,'api');

        $task = factory(Task::class)->create();

        $response = $this->json('DELETE','/api/v1/completed-tasks/' . $task->id);

//        dump($response);

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'completed' => false,
            'user_id' => $task->user_id,
        ]);

        $response->assertJson([
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'completed' => false,
            'user_id' => $task->user_id,
        ]);
    }

}