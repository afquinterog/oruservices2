<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ServiceType::class, function (Faker $faker) {
    return [
      'code' => $faker->randomNumber(3),
    	'name' => $faker->sentence(3),
    	'description' => $faker->sentence,
    	'active' => 1,

        'manager' => function () {
            return factory('App\User')->create()->id;
        },
    ];
});
