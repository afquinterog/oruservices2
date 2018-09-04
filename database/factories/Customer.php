<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Customer::class, function (Faker $faker) {
  return [
  	'code' => $faker->randomNumber(3),
    'firstname' => $faker->sentence(2),
    'lastname' => $faker->sentence(2),
    'email' => $faker->email,
    'address' => $faker->address,
    'phone' => $faker->randomNumber(9),
    'birthday' => $faker->date,

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
