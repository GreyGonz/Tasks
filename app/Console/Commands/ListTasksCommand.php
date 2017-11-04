<?php

namespace App\Console\Commands;

use App\Task;
use Illuminate\Console\Command;

class ListTasksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:list { name ? : Name of the task }';

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
        $header = ['id', 'name', 'created', 'modified'];

        $task = Task::all()->toArray();

        $this->table($header, $task);
    }
}
