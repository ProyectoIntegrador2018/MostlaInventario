<?php

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    protected $campus = [
        "Monterrey",
        "Sonora Norte",
        "Puebla",
        "Aguascalientes",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->campus as $c) {
            Campus::create(['name'=>$c]);
        }
    }
}
