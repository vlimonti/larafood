<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use illuminate\Support\Str;
use App\Models\Tables;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Tables::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'identify' => Str::random(5).uniqid(),
        'description' => $faker->sentence,
    ];
});
