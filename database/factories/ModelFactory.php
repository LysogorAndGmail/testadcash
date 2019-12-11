<?php

use App\User;
use App\Product;
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

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'product_id'=> Product::all()->random()->id,
        'product_price' => Product::all()->random()->price,
        'product_count' => 1,
        'order_sum' => Product::all()->random()->price,
    ];
});
