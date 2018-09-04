<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Department::class, function (Faker $faker) {
    return [
    	'id' => $faker->randomNumber(3),
  		'name' => $faker->sentence(2),
    	'country_id' => function () {
     		return factory('App\Models\Country')->create()->id;
     	}, 	
    ];
});
