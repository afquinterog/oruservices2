<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Company::class, function (Faker $faker) {
	return [

    'code' => $faker->randomNumber(3),
    'name' => $faker->sentence(2),
    'description' => $faker->sentence(8)
      
	];
});