<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Branch::class, function (Faker $faker) {
    return [

    	'code' => $faker->randomNumber(3),
      'name' => $faker->sentence(3),
      'address' => $faker->sentence(6),

      'company_id' => function () {
      	return factory('App\Models\Company')->create()->id;
      },
    ];
});
