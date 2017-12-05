<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApiTaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
//        $this->withoutExceptionHandling();
    }

    protected function loginAsAuthorized()
    {
        $user = factory(User::class)->create();
        $user->assignRole('task-manager');
        $this->actingAs($user, 'api');

        return $user;
    }

    /**
     * @test
     */
    public function canListTasks()
    {
        //prepare

        factory(Task::class, 3)->create();

        $this->loginAsAuthorized();

        // run
        $response = $this->json('GET', 'api/tasks');

        // assert

        $response->assertSuccessful();

        $response->assertJsonStructure([[
            'id',
            'name',
            'created_at',
            'updated_at',
        ]]);
    }

    /**
     * @test
     */
    public function cannotAddTaskIfNoNameProvided()
    {
        // prepare

        $this->loginAsAuthorized();

        // run

        $response = $this->json('POST', '/api/tasks');

        // assert

        $response->assertStatus(422);
    }

    /**
     * StoreTask API
     *
     * @test
     */
    public function cannotAddTaskIfNotLogged()
    {

        // prepare
        Artisan::call('passport:install');
        $faker = Factory::create();

        // run

        $response = $this->json('POST', '/api/tasks', [
            'name' => $name = $faker->word,
        ]);

        // assert

        $response->assertStatus(401);
    }

    /**
     * StoreTask API
     *
     * @test
     */
    public function canAddATask()
    {
        // prepare

        $user = $this->loginAsAuthorized();

        $faker = Factory::create();
        // run

        $response = $this->json('POST', '/api/tasks', [
            'name'    => $name = $faker->word,
            'description' => $description = $faker->text,
            'user_id' => $user->id,
        ]);

        // assert

        $response->assertSuccessful();
        $this->assertDatabaseHas('tasks', [
            'name' => $name,
        ]);

        $response->assertJson([
           'name' => $name,
        ]);
    }

    /**
     * @test
     */
    public function canDeleteTask()
    {

        $this->loginAsAuthorized();

        $task = factory(Task::class)->create();

        $response = $this->json('DELETE', 'api/tasks/'.$task->id);

        $response->assertSuccessful();
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    /**
     * @test
     */
    public function cannotDeleteUnexistingTask()
    {

        $this->loginAsAuthorized();

        $response = $this->json('DELETE', 'api/tasks/1');

        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function canEditTask()
    {

        // prepare

        $faker = Factory::create();
        $task = factory(Task::class)->create();

        $this->loginAsAuthorized();

        // run

        $response = $this->json('PUT', 'api/tasks/'.$task->id, [
            'name' => $newName = $faker->word,
            'description' => $description = $faker->text,
            'user_id' => $task->user_id,
        ]);

        // assert
        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'id'   => $task->id,
            'name' => $newName,
        ]);

        $this->assertDatabaseMissing('tasks', [
            'id'   => $task->id,
            'name' => $task->name,
        ]);
    }
}
