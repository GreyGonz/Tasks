<?php

namespace App\Console\Commands;

use App\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:delete { id? : Task id }';

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
        $collection = Task::where('id', '=', $this->argument('id') ? $this->argument('id') : $this->ask('Task id?'))->get()->toArray();

        if (!empty($collection)) {
            $tasks_to_delete = array_map(function ($task) {
                return $task['id'];
            }, $collection);
            DB::table('tasks')->whereIn('id', $tasks_to_delete)->delete();
            $this->info('Task deleted succesfully');
        } else {
            $this->error("Task specified don't exist");
        }
    }
}
