<?php


use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

if (!function_exists('initialize_task_permissions')) {
    function initialize_task_permissions()
    {
        Permission::firstOrCreate(['name' => 'list-tasks']);
        Permission::firstOrCreate(['name' => 'store-tasks']);
        Permission::firstOrCreate(['name' => 'show-tasks']);
        Permission::firstOrCreate(['name' => 'update-tasks']);
        Permission::firstOrCreate(['name' => 'destroy-tasks']);

        $role = Role::firstOrCreate(['name' => 'task-manager']);

        $role->givePermissionTo('destroy-tasks', 'list-tasks', 'show-tasks', 'store-tasks', 'update-tasks');

        Permission::firstOrCreate(['name' => 'list-users']);
        Permission::firstOrCreate(['name' => 'store-users']);
        Permission::firstOrCreate(['name' => 'show-users']);
        Permission::firstOrCreate(['name' => 'update-users']);
        Permission::firstOrCreate(['name' => 'destroy-users']);

        $role = Role::firstOrCreate(['name' => 'user-manager']);

        $role->givePermissionTo('destroy-users', 'list-users', 'show-users', 'store-users', 'update-users');
    }
}

if (!function_exists('create_user')) {
    function create_user()
    {
        factory(User::class)->create([
            'name'     => env('TASKS_USER_NAME', 'Gerard Rey González'),
            'email'    => env('TASKS_USER_EMAIL', 'gerardrey@iesebre.com'),
            'password' => bcrypt(env('TASKS_USER_PASSWORD')),
        ]);
    }
}

if (!function_exists('create_user_sergi')) {
    function create_user_sergi()
    {
        factory(User::class)->create([
            'name'     => env('TASKS_USER_SERGI_NAME', 'Sergi Tur Bardenas'),
            'email'    => env('TASKS_USER_SERGI_EMAIL', 'sergiturbardenas@iesebre.com'),
            'password' => bcrypt(env('TASKS_USER_SERGI_PASSWORD')),
        ]);
    }
}

if (!function_exists('first_user_as_task_manager')) {
    function first_user_as_task_manager()
    {
        User::findOrFail(1)->assignRole('task-manager');
        User::findOrFail(1)->assignRole('user-manager');
        User::findOrFail(2)->assignRole('task-manager');
        User::findOrFail(2)->assignRole('user-manager');
    }
}
