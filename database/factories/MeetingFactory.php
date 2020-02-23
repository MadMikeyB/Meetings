<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Meeting;
use Faker\Generator as Faker;

$factory->define(Meeting::class, function (Faker $faker) {
    return [
      'name' => $faker->realText(20),
      'series' => $faker->realText(20),
      'location' => $faker->address,
      'room' => $faker->randomDigit,
      'additional' => $faker->realText(200),
      'is_draft' => $faker->boolean,
      'is_complete' => $faker->boolean,
    ];
});
