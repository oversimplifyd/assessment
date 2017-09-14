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
$factory->define(App\Server::class, function (Faker\Generator $faker) {
    return [
        'asset_id' => $faker->unique()->randomDigit,
        'name' => $faker->name,
        'brand' => $faker->colorName,
        'price' => $faker->randomNumber(),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
