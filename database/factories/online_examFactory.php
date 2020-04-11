<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\online_exam::class, function (Faker $faker) {
    return [
        'admin_id' => factory(App\admin::class),
        'online_exam_title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'online_exam_datetime' => $faker->dateTimeBetween($startDate = '-10 days', $endDate = '+10 days', $timezone = null),
        'online_exam_duration' => $faker->numberBetween($min = 1, $max = 10),
        'total_question' => $faker->numberBetween($min = 1, $max = 5),
        'marks_per_right_answer' => $faker->numberBetween($min = 1, $max = 5),
        'marks_per_wrong_answer' => $faker->numberBetween($min = 1, $max = 5),
        'online_exam_status' => $faker->randomElement(['pending...' ,'started', 'completed']),
        'online_exam_code' => $faker->word,
    ];
});
