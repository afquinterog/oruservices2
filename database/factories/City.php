<?php

use Faker\Generator as Faker;

$factory->define(App\Models\City::class, function (Faker $faker) {
  return [
  	'id' => $faker->randomNumber(3),
  	'name' => $faker->sentence(2),
    'department_id' => function () {
     	return factory('App\Models\Department')->create()->id;
     }, 	
  ];
});
