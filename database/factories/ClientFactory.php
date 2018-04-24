<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'active' => 1,
        'email' => $faker->unique()->safeEmail
    ];
});
