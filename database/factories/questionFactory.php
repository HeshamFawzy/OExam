<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\question::class, function (Faker $faker) {
    return [
        'exam_id' => factory(App\online_exam::class),
        'question_title' => $faker->word,
        'answer_option' => $faker->word,
    ];
});
