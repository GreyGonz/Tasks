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
//        $this->withoutExceptionHandling();
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

        $response = $this->get('/tasks_php');

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

        $response = $this->get('/tasks_php/create');

        $response->assertSuccessful();
        $response->assertViewIs('tasks_php.create');
        $response->assertSeeText('Create task');
        $response->assertSeeText('Name:');
    }

    /**
     * StoreTask
     *
     * @test
     */
    public function testStoreTask()
    {
        $this->loginAsUser();

        $response = $this->post('/tasks_php', ['name' => 'ProvaStore']);

        $response->assertSuccessful();
        $this->assertDatabaseHas('tasks', [
            'name' => 'ProvaStore',
        ]);
    }
}
