<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\user_exam_enroll::class, function (Faker $faker) {
    return [
        'examiner_id' => factory(App\examiner::class),
        'exam_id' => factory(App\online_exam::class),
        'attendance_status' => $faker->word,
    ];
});
