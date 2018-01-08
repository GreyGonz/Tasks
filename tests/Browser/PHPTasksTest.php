<?php

namespace Tests\Browser;

use App\Task;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class PHPTasksTest.
 *
 * @package Tests\Browser
 */
class PHPTasksTest extends DuskTestCase
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
        $this->withoutExceptionHandling();
    }

    /**
     * @return mixed
     */
    protected function loginAndAuthorize($browser)
    {
        $user = factory(User::class)->create();
        $user->assignRole('task-manager');
        $browser->loginAs($user);

        return $user;
    }

    /**
     * List tasks.
     * @group prova
     * @test
     * @return void
     */
    public function list_tasks()
    {
        $this->browse(function (Browser $browser)  {
            $tasks = factory(Task::class, 3)->create();
            $browser->maximize();
//            $browser->resize(1920, 1080);
            $this->loginAndAuthorize($browser);

            $browser->visit('/tasks');
            $browser->assertTitleContains('Tasks list');
            //don't see alert message (only show when errors or ok messages)
            $browser->assertMissing('.alert');
            $browser->assertSeeLink('Create Task');

            // See tasks box
            $browser->assertVisible('.box');
            //See box title
            $browser->assertSeein('.box .box-title','Tasks:');
            //see table in box body
            $browser->assertVisible('.box .box-body .table');

//            $browser->pause('50000');

            foreach ($tasks as $task) {
                $browser->assertSee($task->id);
                $browser->assertSee($task->name);
                $browser->assertSee($task->user->id);
                $browser->assertSee($task->user->name);
                $browser->assertVisible('#show-task-' . $task->id);
                $this->assertContains('Show',$browser->text('#show-task-' . $task->id));
                $browser->assertVisible('#edit-task-' . $task->id);
                $this->assertContains('Edit',$browser->text('#edit-task-' . $task->id));
                $browser->assertVisible('#delete-task-' . $task->id);
                $this->assertContains('Delete',$browser->text('#delete-task-' . $task->id));
            }
        });
    }

    /**
     * Create tasks.
     *
     * @test
     * @return void
     */
    public function create_task()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize();
            $user = factory(User::class)->create();
            $user->assignRole('task-manager');
            $this->loginAndAuthorize($browser);

            $browser->visit('/tasks');

            $browser->assertSeeLink('Create a Task');
            $browser->clickLink('Create a Task');
            $browser->assertMissing('.alert');
            //Test back button
            $browser->assertSeeLink('View All Tasks');
            $browser->clickLink('View All Tasks');
            $browser->clickLink('Create a Task');

            // See create task box
            $browser->assertVisible('.container-fluid');
            //see form in box body
            $browser->assertVisible('.container-fluid form');

            //Assert see input for task name
            $browser->assertVisible('.container-fluid form input[name=name]');

            // Assert see input for task description
            $browser->assertVisible('.container-fluid form input[name=description');

            // Assert see select/dropdown for user
//            $browser->assertVisible('.container-fluid form select[name=user_id]');


//            $browser->pause(500000);

            //See box footer
            $browser->assertVisible('.container-fluid form .btn');
            $this->assertContains($browser->text('.container-fluid form .btn'), 'Create');

            //Test validation
            $browser->press('Create');
            $browser->waitFor('.alert');
            $browser->waitForText('The name field is required.');
            $browser->waitForText('The description field is required');

            //Create task
            $browser->type('name', 'Buy bread');
            $browser->type('description', 'yas');
            //Select a random user in users dropdown
            $browser->select('user_id');
            $browser->press('Create');

            $browser->assertPathIs('/tasks');
//            $browser->waitFor('.alert');
//            $browser->waitForText('Created ok!');

//            $browser->clickLink('Back');
            $browser->assertSee('Buy bread');
            $browser->assertSee('yas');

//            $browser->pause(500000);


        });
    }

    /**
     * Show task.
     *
     * @group current
     * @test
     * @return void
     */
    public function show_task()
    {
        $this->browse(function (Browser $browser) {
            $tasks = factory(Task::class, 3)->create();

            $browser->maximize();
            $user = factory(User::class)->create();
            $user->assignRole('task-manager');
            $this->loginAndAuthorize($browser);

            $browser->visit('/tasks');

            $browser->click('#show-task-1');
//            $browser->pause(500000);

            //Test back button
            $browser->assertSeeLink('Back');
            $browser->clickLink('Back');
            $browser->click('#show-task-1');

            //Test edit button
            $browser->assertSeeLink('Edit');
            $browser->clickLink('Edit');
//            $browser->click('#show-task-1');

            $browser->assertPathIs('/tasks_php/edit/1');
            $browser->assertSeeLink('Back');
            $browser->clickLink('Back');

            //Test delete button
//            $browser->assertSeeLink('Delete');
//            $browser->clickLink('Delete');
//            $browser->click('#show-task-1');

        });
    }
}
