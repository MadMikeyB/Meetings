<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expectation;
use Faker\Generator as Faker;

$factory->define(Expectation::class, function (Faker $faker) {
    return [
      'description' => $faker->realText(20),
        //
    ];
});
