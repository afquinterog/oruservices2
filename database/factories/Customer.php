<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
    	'code' => $faker->randomNumber(3),
      'firstname' => $faker->sentence(3),
      'lastname' => $faker->sentence(6),
      'email' => $faker->sentence(3),
      'address' => $faker->sentence(3),
      'phone' => $faker->sentence(3),
      'birthday' => $faker->sentence(3),

      'company_id' => function () {
      	return factory('App\Models\Company')->create()->id;
      },
      'city_id' => function () {
      	return factory('App\Models\City')->create()->id;
      },
      'category_id' => function () {
      	return factory('App\Models\Category')->create()->id;
      },
    ];
});
