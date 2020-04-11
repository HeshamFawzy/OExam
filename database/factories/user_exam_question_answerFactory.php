<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\user_exam_question_answer::class, function (Faker $faker) {
    return [
        'examiner_id' => factory(App\examiner::class),
        'exam_id' => factory(App\online_exam::class),
        'question_id' => factory(App\question::class),
        'user_answer_option' => $faker->word,
        'marks' => $faker->word,
    ];
});
