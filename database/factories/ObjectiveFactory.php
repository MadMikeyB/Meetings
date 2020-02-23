<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Objective;
use Faker\Generator as Faker;

$factory->define(Objective::class, function (Faker $faker) {
    return [
      'description' => $faker->realText(20),
      'percent_done' => $faker->numberBetween(0,100),
        //
    ];
});
