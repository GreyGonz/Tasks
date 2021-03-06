<?php

namespace App\Console\Commands;

use App\Task;
use Illuminate\Console\Command;
use Mockery\Exception;

class EditTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:edit { id? : TaskResource id }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $task = Task::find($id = $this->argument('id') ? $this->argument('id') : $this->ask('TaskResource id?'));

            if ($task) {
                $task->name = $this->ask('New task name?');
                $task->save();
                $this->info('TaskResource edited successfully');
            } else {
                $this->error('TaskResource with id '.$id.' not found');
            }
        } catch (Exception $e) {
            $this->error('Uups! Something go wrong :(');
        }
    }
}
