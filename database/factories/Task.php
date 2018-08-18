<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Task::class, function (Faker $faker) {
    return [

        'name' => $faker->title,
        'description' => $faker->sentence(3),
        'order' => $faker->randomNumber(3),

        'service_type_id' => function () {
            return factory('App\Models\ServiceType')->create()->id;
        },
    ];
});