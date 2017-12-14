<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name'        => $faker->word,
        'description' => $faker->text,
        'completed'   => $faker->boolean(50),
        'user_id'     => factory(User::class)->create()->id,
    ];
});
