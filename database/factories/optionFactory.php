<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\option::class, function (Faker $faker) {
    return [
        'question_id' => factory(App\question::class),
        'option_number' => $faker->numberBetween($min = 1, $max = 4),
        'option_title' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
