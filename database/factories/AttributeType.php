<?php

use Faker\Generator as Faker;


$factory->define(App\Models\AttributeType::class, function (Faker $faker) {
    return [
			
			'code' => $faker->randomNumber(3),
      'name' => $faker->title,
      'active' => 1,
      'description' => $faker->sentence
    ];
});
