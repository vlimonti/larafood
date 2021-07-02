<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use App\Models\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word.Str::random(5),
        'price' => 89.0,
        'description' => $faker->sentence,
    ];
});
