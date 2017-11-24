<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name'    => $faker->name,
        'user_id' => factory(User::class)->create()->id,
    ];
});
