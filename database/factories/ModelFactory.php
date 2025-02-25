<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Auth\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'other_names' => $faker->firstName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'username' => $faker->userName,
        'password' => \Illuminate\Support\Facades\Hash::make($password ?: 'secret')
    ];
});

$factory->define(\App\Models\Post::class, function (\Faker\Generator $faker) {
    return [
        'title' => $faker->jobTitle,
        'description' => $faker->paragraph,
        'user_id' => null
    ];
});

