<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use View;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    protected function loginAsUser()
    {
        $login = factory(User::class)->create();
        $this->actingAs($login);
        View::share('user', $login);

        return $login;
    }

    /**
     * ListTasks
     *
     * @test
     */
    public function index_view_list_all_tasks()
    {
        $this->loginAsUser();

        $tasks = factory(Task::class, 50)->create();

        $response = $this->get('/tasks');

        $response->assertSuccessful();
        $response->assertSeeText('Tasks PHP');
        foreach ($tasks as $task) {
            $response->assertSeeText($task->name);
        }
    }

    /**
     * CreateTask
     *
     * @test
     */
    public function create_task_view()
    {
        $this->loginAsUser();

        $response = $this->get('/tasks/create');

        $response->assertSuccessful();
        $response->assertViewIs('tasks.create');
        $response->assertSeeText('Create task');
        $response->assertSeeText('Name:');
    }

    /**
     * StoreTask
     *
     * @test
     */
    public function store_task()
    {
        $this->loginAsUser();

        $task = factory(Task::class)->create();

        $response = $this->post('/tasks',['name' => $task->name]);

        $response->assertStatus(302);
//        $response->assertViewIs('tasks.index');
        $this->assertDatabaseHas('tasks', [
            'name' => $task->name,
        ]);
    }

    /**
     * TODO STORE
     */

    /**
     * ShowTask
     *
     * @test
     */
    public function show_task()
    {
        $this->loginAsUser();

        $task = factory(Task::class)->create();

        $response = $this->get('/tasks/'.$task->id);

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id
        ]);
        $response->assertSeeText($task->name);
    }
}
