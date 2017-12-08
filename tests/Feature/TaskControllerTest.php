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

        $response = $this->get('/tasks');

        $response->assertSuccessful();
        $response->assertSeeText('Tasks PHP');
        foreach ($tasks as $task) {
            $response->assertSeeText($task->name);
        }
    }

    /**
     * ListTasks
     *
     * @test
     */
    public function index_view_fail_not_logged()
    {
        factory(Task::class, 50)->create();

        $response = $this->get('tasks');

        $response->assertRedirect('login');
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
     * CreateTask
     *
     * @test
     */
    public function create_task_view_fail_not_logged()
    {
        $response = $this->get('/tasks/create');

        $response->assertRedirect('login');
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

        $response = $this->post('/tasks',[
            'name' => $task->name,
            'description' => $task->description,
            'user_id' => 1,
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'name' => $task->name,
        ]);
    }

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
        $response->assertSeeText($task->name);
        $response->assertSeeText($task->description);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id
        ]);
    }

    /**
     * ShowTask
     *
     * @test
     */
    public function show_task_not_found()
    {
        $this->loginAsUser();

        $response = $this->get('/tasks/1');

        $response->assertStatus(404);

    }

    /**
     * EditTask
     *
     * @test
     */
    public function edit_view_task()
    {
        $this->loginAsUser();

        $task = factory(Task::class)->create();

        $request = $this->get('tasks/'.$task->id.'/edit');

        $request->assertSuccessful();

        $request->assertSeeText('Name:');
        $request->assertSeeText('Description:');
        $request->assertSee($task->name);
        $request->assertSee($task->description);
    }

    /**
     * UpdateTask
     *
     * @test
     */
    public function update_task()
    {
        $this->loginAsUser();

        $task = factory(Task::class)->create();
        $newTask = factory(Task::class)->make();

        $response = $this->put('tasks/'.$task->id, [
            'name' => $newTask->name,
            'description' => $newTask->description,
        ]);

        $response->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $newTask->name,
            'description' => $newTask->description,
        ]);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
        ]);

    }

    /**
     * DestroyTask
     *
     * @test
     */
    public function destroy_task()
    {
        $this->loginAsUser();

        $task = factory(Task::class)->create();

        $response = $this->delete('tasks/'.$task->id);

        $response->assertRedirect('/tasks');

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
