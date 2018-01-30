<?php

namespace Tests\Browser;

use App\Task;
use App\User;
use Tests\Browser\Pages\VueTasksCrudPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class VueTasksTest
 * @package Tests\Browser
 * @group run
 */
class VueTasksCrudTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
//        Artisan::call('passport:install');
//        $this->withoutExceptionHandling();
    }

    /**
     * Create user.
     *
     * @return mixed
     */
    protected function createUser()
    {
        return factory(User::class)->create();
    }

    /**
     * Assign role task manager.
     *
     * @param $user
     */
    protected function assignRoleTaskManager($user)
    {
        $user->assignRole('task-manager');
    }

    /**
     * @return mixed
     */
    protected function login($browser)
    {
        $user = $this->createUser();
        $this->assignRoleTaskManager($user);
        $browser->loginAs($user);
        return $user;
    }

    /**
     * List tasks.
     *
     * @test
     * @return void
     */
    public function list_tasks()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $tasks = factory(Task::class, 2)->create();
            $browser->maximize();
            $browser->visit(new VueTasksCrudPage())
                    ->assert('Tasks')
                    ->seeTitle('Tasks')
                    ->dontSeeAlert('Tasks')
                    ->seeBox('Tasks')
                    ->assertVue('tasks', $tasks->toArray(), '@component')
                    ->seeTasks($tasks);
        });
    }

    /**
     * Reload.
     *
     * @test
     *
     */
    public function reload()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $tasks = factory(Task::class, 5)->create();
            $browser->maximize();
            $browser->visit(new VueTasksCrudPage())
                ->seeTitle('Tasks')
                ->dontSeeAlert('Tasques new')
                ->seeBox('Tasks')
                ->assertVue('tasks', $tasks->toArray(), '@component')
                ->seeTasks($tasks);

            foreach ($tasks as $task) {
                $task->delete();
            }

            $tasks = factory(Task::class, 100)->create();

            $browser->reload()
                ->assertVue('loading', true, '@component')
                ->waitUntilMissing('div.overlay>.fa-refresh')
                ->assertVue('loading', false, '@component')
                ->seeTasks($tasks);
        });
    }

    /**
     * See completed tasks.
     *
     * @test
     */
    public function see_completed_tasks()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $tasks = factory(Task::class, 5)->create();
            $completed_tasks = factory(Task::class, 1)->states('completed')->create();

            $browser->maximize();
            $browser->visit(new VueTasksCrudPage())
                ->applyCompletedFilter()
                ->seeTasks($completed_tasks)
                ->dontSeeTasks($tasks);
        });
    }

    /**
     * See pending tasks.
     *
     * @test
     * @group current
     *
     */
    public function see_pending_tasks()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $tasks = factory(Task::class, 1)->create();
            $completed_tasks = factory(Task::class, 3)->states('completed')->create();

            $browser->maximize();
            $browser->visit(new VueTasksCrudPage())
                ->applyPendingFilter()
                ->seeTasks($tasks)
                ->pause(1000)
                ->dontSeeTasks($completed_tasks);
        });
    }

    /**
     * Add task
     * @test
     */
    public function add_task()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $browser->maximize();
            $task = factory(Task::class)->make();
            $browser->visit(new VueTasksCrudPage())
                ->store_task($task)
                ->assertVue('adding', true, '@component') //  Test state
                ->waitForSuccessfulCreateAlert($task) // TODO
                ->assertVue('adding', false, '@component')
                ->seeTask($task, '#task-name-1');
        });
    }

    /**
     * Edit task
     * @test
     *
     */
    public function edit_task()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $browser->maximize();
            $oldTask = factory(Task::class)->create();
            $newtask = factory(Task::class)->make();
            $newtask->id = $oldTask->id;
            $selector = '#task-name-'.$oldTask->id;
            $browser->visit(new VueTasksCrudPage())
                ->update_task($oldTask, $newtask)
                ->assertVue('loading', true, '@component') //  Test state
                ->waitForSuccessfulEditAlert($newtask) // TODO
                ->assertVue('loading', false, '@component') //  Test state
                ->seeTask($newtask, $selector)
                ->assertDontSeeIn($selector, $oldTask->name);
        });
    }

    /**
     * Cancel edit
     * @test
     *
     */
    public function cancel_edit()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $browser->maximize();
            $oldTask = factory(Task::class)->create();
            $newtask = factory(Task::class)->make();
            $newtask->id = $oldTask->id;
            $browser->visit(new VueTasksCrudPage())
                ->cancel_update_task($oldTask, $newtask)
                ->seeTask($oldTask, '#task-name-'.$oldTask->id)
                ->assertDontSeeIn('#task-name-'.$oldTask->id, $newtask->name);
        });
    }

    /**
     * Delete task
     * @test
     *
     */
    public function delete_task()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $browser->maximize();
            $task = factory(Task::class)->create();
            $browser->visit(new VueTasksCrudPage())
                ->destroy_task($task)
                ->assertVue('loading', true, '@component') //  Test state
                ->waitForSuccessfulDeleteAlert($task) // TODO
                ->assertVue('loading', false, '@component') //  Test state
                ->dontSeeTask('#task-name-'.$task->id);
        });
    }

    /**
     * Cancel delete task
     * @test
     *
     */
    public function cancel_delete_task()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $browser->maximize();
            $task = factory(Task::class)->create();
            $browser->visit(new VueTasksCrudPage())
                ->cancel_destroy_task($task)
                ->seeTask($task, '#task-name-'.$task->id);
        });
    }

    /**
     * Toogle complete task.
     * @test
     */
    public function toogle_complete_task()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $browser->maximize();
            $task = factory(Task::class)->create();
            $browser->visit(new VueTasksCrudPage())
                ->toogle_complete($task)
                ->toogle_complete($task);
        });
    }
}
