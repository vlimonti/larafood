<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'name' => $faker->unique()->word.Str::random(5),
        'description' => $faker->sentence,
        'image' => 'pizza.png',
        'price' => 10.5,
    ];
});
