<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NextStep;
use Faker\Generator as Faker;

$factory->define(NextStep::class, function (Faker $faker) {
    return [
      'description' => $faker->realText(20),
      'completed_by_date' => $faker->dateTimeThisDecade(),
      'is_complete' => $faker->boolean(),
    ];
});
