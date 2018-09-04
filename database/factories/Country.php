<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Country::class, function (Faker $faker) {
  return [
  	'id' => $faker->randomNumber(3),
  	'name' => $faker->sentence(2),
  ];
});
