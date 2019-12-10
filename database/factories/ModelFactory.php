<?php

use App\SalesActivity;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'full_name' => $faker->firstName.' '.$faker->lastName
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
		'price'=> $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 22)
    ];
});
