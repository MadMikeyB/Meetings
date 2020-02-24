<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Day;
use Faker\Generator as Faker;

$factory->define(Day::class, function (Faker $faker) {
  $t1 = $faker->time('H:i:s');
  $t2 = $faker->time('H:i:s');
    return [
      'date' => $faker->date('Y-m-d', null),
      'start_at' => $t1 < $t2 ? $t1 : $t2,
      'end_at' => $t1 < $t2 ? $t2 : $t1,
        //
    ];
});
