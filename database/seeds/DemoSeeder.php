<?php

use App\Models\Product;
use App\Models\Reservation;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'email' => 'happybits19@gmail.com',
            'type_id' => 4,
            'campus_id' => 15,
        ]);
        UserRole::create([
            'email' => 'happybits19@gmail.com',
            'type_id' => 3,
            'campus_id' => 23,
        ]);

        $product = Product::create([
            'brand' => 'Apple',
            'model' => '',
            'name' => 'iPhone X',
            'category_id' => 2,
            'description' => 'Teléfono celular nuevo de Apple.',
        ]);
        $product->campus()->sync([15,23]);
        $product->tags()->sync([1,7,12]);
        $product->units()->createMany([
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => 'Tiene Flappy Bird instalado.',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => 'No tiene Flappy Bird instalado.',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => '',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => '',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 23,
                'comments' => 'No tiene Flappy Bird instalado.',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 23,
                'comments' => '',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 23,
                'comments' => '',
            ],
        ]);

        $product = Product::create([
            'brand' => 'LG',
            'model' => 'LGH870',
            'name' => 'G6',
            'category_id' => 2,
            'description' => 'Teléfono celular marca LG.',
        ]);
        $product->campus()->sync([15, 23]);
        $product->tags()->sync([1,11,12]);
        $product->units()->createMany([
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => 'Tiene Flappy Bird instalado.',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => 'No tiene Flappy Bird instalado.',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => '',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 23,
                'comments' => 'No tiene Flappy Bird instalado.',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 23,
                'comments' => '',
            ],
        ]);

        $product = Product::create([
            'brand' => 'Occulus',
            'model' => '',
            'name' => 'Rift',
            'category_id' => 3,
            'description' => 'Set de realidad virtual que incluye un visor de VR y dos controles.',
        ]);
        $product->campus()->sync([15]);
        $product->tags()->sync([3,2]);
        $product->units()->createMany([
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => '',
            ],
            [
                'serial_number' => '12-345-67890',
                'campus_id' => 15,
                'comments' => '',
            ],
        ]);

        Reservation::create([
            'user_id'=>1,
            'product_id'=>1,
            'campus_id'=>15,
            'start_date'=>now()->addHours(4),
            'end_date'=>now()->addDays(5)
        ]);

        Reservation::create([
            'user_id'=>1,
            'product_id'=>11,
            'campus_id'=>15,
            'start_date'=>now()->addHours(2),
            'end_date'=>now()->addDays(4)
        ]);

        Reservation::create([
            'user_id'=>1,
            'product_id'=>21,
            'campus_id'=>15,
            'start_date'=>now()->addHours(24),
            'end_date'=>now()->addDays(3)
        ]);
    }
}
