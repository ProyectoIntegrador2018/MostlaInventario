<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Reservation;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'campus_id' => 1,
        'start_date' => now()->addDay(),
        'end_date' => now()->addDay()->addHours(4),
        'product_id' => factory(Product::class, 1)->create()->first()->id,
        'quantity' => $faker->numberBetween(2, 6)
    ];
});
