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
class APIAttendedTaskControllerTest extends TestCase
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
        $this->withoutExceptionHandling();
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
     * Update
     *
     * @test
     */
    public function update()
    {
        $user = factory(User::class)->create();
        $this->loginAsManager($user,'api');
        $task = factory(Task::class)->create();

        $response = $this->json('PUT', '/api/v1/tasks/' . $task->id . '/description',[
            'description' => 'new description'
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $task->name,
            'description' => 'new description',
            'completed' => $task->completed,
            'user_id' => $task->user_id,
        ]);

        $response->assertJson([
            'id' => $task->id,
            'name' => $task->name,
            'description' => 'new description',
            'completed' => $task->completed,
            'user_id' => $task->user_id,
        ]);
    }

}