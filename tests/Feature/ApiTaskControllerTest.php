<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTaskControllerTest extends TestCase {

    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
//        $this->withoutExceptionHandling();
    }

    /**
     * @test
     *
     */
    public function canListTasks()
    {
        //prepare

        $tasks = factory(Task::class, 3)->create();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        // run
        $response = $this->json('GET', 'api/tasks');

        // assert

        $response->assertSuccessful();

        $response->assertJsonStructure([[
            'id',
            'name',
            'created_at',
            'updated_at'
        ]]);
    }


    /**
     * @test
     */
    public function cannotAddTaskIfNoNameProvided() {
        // prepare

        $user = factory(User::class)->create();
        $this->actingAs($user);

        // run

        $response = $this->json('POST', '/api/tasks');

        // assert

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function cannotAddTaskIfNotLogged() {

        // prepare

        $faker = Factory::create();

        // run

        $response = $this->json('POST', '/api/tasks', [
            'name' => $name = $faker->word
        ]);

        // assert

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function canAddATask()
    {
        // prepare

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $faker = Factory::create();

        // run

        $response = $this->json('POST', '/api/tasks', [
            'name' => $name = $faker->word
        ]);

        // assert

        $response->assertSuccessful();
        $this->assertDatabaseHas('tasks', [
            'name' => $name
        ]);

        $response->assertJson([
           'name' => $name
        ]);

    }

    /**
     * @test
     */
    public function canDeleteTask() {

        // prepare
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $task = factory(Task::class)->create();

        // run

        $response = $this->json('DELETE', 'api/tasks/' . $task->id);

        // assert

        $response->assertSuccessful();
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }

    /**
     * @test
     */
    public function cannotDeleteUnexistingTask() {

        // prepare
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // run

        $response = $this->json('DELETE', 'api/tasks/1');

        // assert

        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function canEditTask() {

        // prepare

        $faker = Factory::create();
        $task = factory(Task::class)->create();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        // run

        $response = $this->json('PUT', 'api/tasks/' . $task->id, [
            'name' => $newName = $faker->word
        ]);

        // assert
        $response->assertSuccessful();

        $this->assertDatabaseHas( 'tasks', [
            'id' => $task->id,
            'name' => $newName
        ]);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'name' => $task->name
        ]);

    }
}