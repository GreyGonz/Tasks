<?php

use App\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        initialize_task_permissions();

        create_user();

        create_user_sergi();

        first_user_as_task_manager();

        $this->call('TimelineSeeder');
//        $this->call('AdminUserSeeder');
        factory(Task::class, 10)->create();

        Artisan::call('passport:install');
    }
}
