<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\option::class, function (Faker $faker) {
    return [
        'question_id' => factory(App\question::class),
        'option_number' => $faker->randomNumber(),
        'option_title' => $faker->word,
    ];
});
