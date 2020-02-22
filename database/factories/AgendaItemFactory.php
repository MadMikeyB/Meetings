<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AgendaItem;
use Faker\Generator as Faker;

$factory->define(AgendaItem::class, function (Faker $faker) {
    return [
      'type' => $faker->numberBetween(1,8),
      'name' => $faker->realText(20),
      'additional' => $faker->realText(200),
      'expected_number_of_minutes' => $faker->numberBetween(1,60),
    ];
});
