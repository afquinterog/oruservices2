<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Attribute::class, function (Faker $faker) {
    return [

      'name' => $faker->sentence(3),
      'code' => $faker->randomNumber(3),
      'active' => 1, 

      'attribute_type_id' => function () {
      	return factory('App\Models\AttributeType')->create()->id;
      },
    ];
});
