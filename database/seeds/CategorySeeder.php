<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected $categories = [
        "Impresión 3D",
        "Telepresencia",
        "Drones",
        "Realidad Virtual",
        "Internet de las cosas",
        "Inteligencia Artificial",
        "Asistentes Virtuales",
        "Blockchain"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            Category::create(['name'=>$category]);
        }
    }
}
