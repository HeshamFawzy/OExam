<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\examiner::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'gender' => $faker->word,
        'address' => $faker->text,
        'mobile_no' => $faker->randomNumber(),
        'filename' => $faker->word,
        'mime' => $faker->word,
        'original_filename' => $faker->word,
    ];
});
