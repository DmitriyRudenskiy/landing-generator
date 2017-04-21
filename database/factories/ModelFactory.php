<?php

$factory->define(App\Models\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});


$factory->define(App\Models\UserProfile::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});