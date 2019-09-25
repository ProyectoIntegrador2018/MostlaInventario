<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Reservation;
use App\Models\ReservationDetail;
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
        'start_date' => now(),
        'end_date' => now(),
    ];
});

$factory->define(ReservationDetail::class, function (Faker $faker) {
	return [
		'product_id' => factory(Product::class,1)->create()->first()->id
	];
});

$factory->afterCreating(Reservation::class, function ($reservation, Faker $faker) {
	$reservation->details()->createMany(
		factory(ReservationDetail::class, $faker->numberBetween(2,6))->make()->toArray()
	);
});