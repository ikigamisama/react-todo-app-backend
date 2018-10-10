<?php

use Faker\Generator as Faker;
use App\Todo;
use App\User;

$factory->define(App\Todo::class, function (Faker $faker) {
    return [
        'todo_name' => $faker->name,
        'todo_description' =>  $faker->paragraph,
        'user_id' => App\User::all()->random()->id,
        'todo_date' => date('Y-m-d'),
        'todo_time' => date('H:i:s'),
        'is_already_todo' => "false"

    ];
});
