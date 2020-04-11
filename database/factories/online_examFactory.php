<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\online_exam::class, function (Faker $faker) {
    return [
        'admin_id' => factory(App\admin::class),
        'online_exam_title' => $faker->word,
        'online_exam_datetime' => $faker->dateTime(),
        'online_exam_duration' => $faker->word,
        'total_question' => $faker->randomNumber(),
        'marks_per_right_answer' => $faker->word,
        'marks_per_wrong_answer' => $faker->word,
        'online_exam_status' => $faker->word,
        'online_exam_code' => $faker->word,
    ];
});
