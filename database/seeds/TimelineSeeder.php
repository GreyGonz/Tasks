<?php

use App\TaskEvent;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TaskEvent::create([
        'time' => Carbon::now()->subDays(30),
        'type' => 'deleted',
//      'task_name' => $task->name,
        'task' => '{ "name":"Deleted Task" }',
        'user_name' => 'Paquito',
      ]);

      TaskEvent::create([
        'time' => Carbon::now()->subDays(20),
        'type' => 'updated',
//      'task_name' => $task->name,
        'task' => '{ "id":"200000000", "name":"Updated Task" }',
        'user_name' => 'Paquito',
      ]);

    }
}
