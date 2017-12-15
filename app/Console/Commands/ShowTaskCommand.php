<?php

namespace App\Console\Commands;

use App\Task;
use Illuminate\Console\Command;
use Mockery\Exception;

class ShowTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:show { name? : TaskResource name }';

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
            $task = Task::where('name', '=', $name = $this->argument('name') ? $this->argument('name') : $this->ask('TaskResource name?'))->get()->toArray();

            $tasksShown = count($task);

            $header = ['id', 'name', 'created', 'modified'];

            if ($task) {
                $this->table($header, $task);
                $this->info($tasksShown.' Tasks shown');
            } else {
                $this->error('TaskResource '.$name.' not found');
            }
        } catch (Exception $e) {
            $this->error('Uups! Somthing go wrong!');
        }
    }
}
