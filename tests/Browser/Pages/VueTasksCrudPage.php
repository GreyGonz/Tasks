<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

/**
 * Class VueTasksPage.
 *
 * @package Tests\Browser\Pages
 *
 */
class VueTasksCrudPage extends BasePage
{
    const TITLE = 'Tasks';

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/tasks_component';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@component'            => '#tasks-list',
            '@reload'               => '#reload',
            '@completed'            => '#completed-tasks',
            '@pending'              => '#pending-tasks',
            '@all'                  => '#all-tasks',
            '@store-task'           => '#store-task',       // Add task button or link or...
            '@update-task'          => '.update-task',      // Update task button or link or... Update update task in database
            '@destroy-task'         => '#destroy-task',     // Destroy task button or link or... Destroy delete
            '@cancel'               => '.cancel-button',  // Cancel delete task button or link or... Destroy delete
            '@toogle-complete-task' => '#complete-task',    // Toogle complete task button or link or...

            // TODO : sort and pagination
        ];
    }

    /**
     * See title.
     *
     * @param Browser $browser
     */
    public function seeTitle(Browser $browser)
    {
        $browser->assertTitleContains(self::TITLE);
    }

    /**
     * See box.
     *
     * @param Browser $browser
     */
    public function seeBox(Browser $browser, $title)
    {
        $browser->assertVisible('.box');
        $browser->assertSeein('.box .box-title', $title);
        $browser->assertVisible('.box .box-body table');
    }

    /**
     * See tasks on page.
     *
     * @param Browser $browser
     * @param $tasks
     */
    public function seeTasks(Browser $browser, $tasks)
    {
        foreach ($tasks as $task) {
            $this->seeTask($browser, $task, "#task-name-".$task->id);
        }
        $browser->assertSee(count($tasks) . ' tasks left');
    }

    /**
     * See task.
     *
     * @param Browser $browser
     * @param $task
     */
    public function seeTask(Browser $browser, $task, $selector)
    {
        $browser->assertSeeIn($selector, $task->name);
    }

    /**
     * See tasks on page.
     *
     * @param Browser $browser
     * @param $tasks
     */
    public function dontSeeTasks(Browser $browser, $tasks)
    {
        foreach ($tasks as $task) {
            $this->dontSeeTask($browser, '#task-name-'.$task->id);
        }
    }

    /**
     * Don't see task.
     *
     * @param Browser $browser
     * @param $task
     */
    public function dontSeeTask(Browser $browser, $selector)
    {
        $browser->assertMissing($selector);
    }

    /**
     * Apply completed filter.
     *
     * @param Browser $browser
     */
    public function applyCompletedFilter(Browser $browser)
    {
        $browser->press('@completed');
    }

    /**
     * Apply pending filter.
     *
     * @param Browser $browser
     */
    public function applyPendingFilter(Browser $browser)
    {
        $browser->press('@pending');
    }

    /**
     * Apply all filter.
     *
     * @param Browser $browser
     */
    public function applyAllFilter(Browser $browser)
    {
        $browser->press('@all');
    }

    /**
     * Dont see alert.
     *
     * @param Browser $browser
     */
    public function dontSeeAlert(Browser $browser)
    {
        $browser->assertMissing('.alert');
    }

    /**
     * Press reload button.
     */
    public function reload(Browser $browser)
    {
        $browser->press('@reload');
    }

    /**
     * Store task.
     *
     * @param Browser $browser
     * @param $task
     */
    public function store_task(Browser $browser, $task)
    {
        $browser->type('name', $task->name);
        $browser->type('description', $task->description);
        $this->store($browser);
    }

    /**
     * Update task.
     *
     * @param Browser $browser
     * @param $newTask
     */
    public function update_task(Browser $browser, $task, $newTask)
    {
        //Init edit
        $this->edit($browser, $task);
        $browser->type('taskNameEdit', $newTask->name);
        //Confirm edit
        $this->update($browser);
    }

    /**
     * Cancel update task.
     *
     * @param Browser $browser
     * @param $newTask
     */
    public function cancel_update_task(Browser $browser, $task, $newTask)
    {
        //Init edit
        $this->edit($browser, $task);
        $browser->type('taskNameEdit', $newTask->name);

        $this->cancel($browser);
    }

    public function cancel(Browser $browser)
    {
        $browser->press('@cancel');
    }

    /**
     * Press create button.
     */
    public function store(Browser $browser)
    {
        $browser->press('@store-task');
    }

    /**
     * Press edit button.
     */
    public function edit(Browser $browser, $task)
    {
        $browser->press('#task-name-' .  $task->id);
        $browser->waitFor('#task-name-edit');
    }

    /**
     * Press update button.
     */
    public function update(Browser $browser)
    {
        $browser->press('@update-task');
    }

    /**
     * Destroy task.
     * @param Browser $browser
     * @param $task
     */
    public function destroy_task(Browser $browser, $task)
    {
        //Init delete
        $this->delete($browser, $task);
        //Confirm delete
        $this->destroy($browser); // No need of task-> only one visible confirm exists
    }

    /**
     * Cancel Destroy task.
     *
     * @param Browser $browser
     * @param $task
     */
    public function cancel_destroy_task(Browser $browser, $task)
    {
        //Init delete
        $this->delete($browser, $task);
        //Cancel delete
        $this->cancel_delete($browser); // TODO
    }

    public function toogle_complete(Browser $browser, $task) // TODO
    {
        $browser->press('#task-toggle-'.$task->id);
    }

    /**
     * Press delete button.
     */
    public function delete(Browser $browser, $task)
    {
        $browser->press('#delete-task-' . $task->id);
    }

    /**
     * Press destroy button.
     */
    public function destroy(Browser $browser)
    {
        $browser->waitFor('#modal-confirm-delete');
        $browser->press('@destroy-task');
    }

    /**
     * Press cancel delete button.
     */
    public function cancel_delete(Browser $browser)
    {
        $browser->waitFor('#modal-confirm-delete');
        $browser->press('#cancel-delete');
    }

    public function waitForSuccessfulCreateAlert(Browser $browser, $task)
    {
        $browser->waitFor('#message-box');
        $browser->assertSee('Task added successfully!');
    }

    public function waitForSuccessfulEditAlert(Browser $browser, $task)
    {
        $browser->waitFor('#message-box');
        $browser->assertSee('Task updated successfuly!');
    }

    public function waitForSuccessfulDeleteAlert(Browser $browser, $task)
    {
        $browser->waitFor('#message-box');
        $browser->assertSee('Task deleted successfuly!');
    }
}
