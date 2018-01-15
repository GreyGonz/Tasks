<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
     * ListTask API.
     *
     * @test
     */
    public function List_task()
    {
        //prepare

        $tasks = factory(Task::class, 3)->create();
        $this->loginAsAuthorized();

        // run
        $response = $this->json('GET', 'api/tasks');

        // assert

        $response->assertSuccessful();

        foreach ($tasks as $task) {
            $response->assertJsonFragment([
                'id'          => $task->id,
                'name'        => $task->name,
                'description' => $task->description,
                'completed'   => $task->completed,
                'user_id'     => $task->user_id,
                'created_at'  => $task->created_at->toDateTimeString(),
                'updated_at'  => $task->updated_at->toDateTimeString(),
            ]);
        }

        $response->assertJsonStructure([
            'data' => [[
                'id',
                'name',
                'description',
                'completed',
                'user_id',
                'created_at',
                'updated_at',
            ]]
        ]);
    }

    /**
     * ShowTask API.
     *
     * @test
     */
    public function show_task()
    {
        $this->loginAsAuthorized();
        $task = factory(Task::class)->create();

        $response = $this->json('GET', 'api/tasks/'.$task->id);

        $response->assertSuccessful();

        $response->assertJsonFragment([
            'id'          => $task->id,
            'name'        => $task->name,
            'description' => $task->description,
            'completed'   => $task->completed,
            'user_id'     => $task->user_id,
        ]);
    }

    /**
     * ShowTask API.
     *
     * @test
     */
    public function show_task_fail_if_not_found()
    {
        $this->loginAsAuthorized();

        $response = $this->json('GET', 'api/tasks/1');

        $response->assertStatus(404);
    }

    /**
     * StoreTask API.
     *
     * @test
     */
    public function store_task()
    {
        // prepare

        $user = $this->loginAsAuthorized();

        $faker = Factory::create();
        // run

//        dd($user);
        $response = $this->json('POST', '/api/tasks', [
            'name'        => $name = $faker->word,
            'description' => $description = $faker->text,
            'completed'   => $completed = $faker->boolean,
        ]);

        // assert

        $response->assertSuccessful();
        $this->assertDatabaseHas('tasks', [
            'name'        => $name,
            'description' => $description,
            'completed'   => $completed,
        ]);

        $response->assertJson([
            'name'        => $name,
            'description' => $description,
            'completed'   => $completed,
        ]);
    }

    /**
     * StoreTask API.
     *
     * @test
     */
    public function store_api_fail_if_no_name_provided()
    {
        // prepare

        $this->loginAsAuthorized();

        // run

        $response = $this->json('POST', '/api/tasks');

        // assert

        $response->assertStatus(422);
    }

    /**
     * DeleteTask API.
     *
     * @test
     */
    public function delete_task()
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
     * DeleteTask API.
     *
     * @test
     */
    public function delete_task_fail_if_task_dont_exist()
    {
        $this->loginAsAuthorized();

        $response = $this->json('DELETE', 'api/tasks/1');

        $response->assertStatus(404);
    }

    /**
     * EditTask API.
     *
     * @test
     */
    public function edit_task()
    {

        // prepare

        $faker = Factory::create();
        $task = factory(Task::class)->create();

        $this->loginAsAuthorized();

        // run

        $response = $this->json('PUT', 'api/tasks/'.$task->id, [
            'name'        => $newName = $faker->word,
            'description' => $newDescription = $faker->text,
            'completed'   => $newCompleted = $faker->boolean
        ]);

        // assert
        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'id'          => $task->id,
            'name'        => $newName,
            'description' => $newDescription,
            'completed'   => $newCompleted
        ]);

        $this->assertDatabaseMissing('tasks', [
            'id'          => $task->id,
            'name'        => $task->name,
            'description' => $task->description,
            'completed'   => $task->completed
        ]);
    }

    /**
     * EditTask API.
     *
     * @test
     */
    public function edit_task_api_fail_if_task_not_found()
    {
        $this->loginAsAuthorized();

        $response = $this->json('PUT', 'api/tasks/1', [
            'name'        => 'ProvaEdit',
            'description' => 'ProvaEdit',
        ]);

        $response->assertStatus(404);
    }
}
