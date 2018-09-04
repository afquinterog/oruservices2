<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Role::class, function (Faker $faker) {
		return [
    	'name' => $faker->sentence(1),
    	'title' => $faker->sentence(1),
    ];
});
