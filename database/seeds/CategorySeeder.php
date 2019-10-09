<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected $categories = [
        "Computadoras",
        "Consolas",
        "Móviles",
        "Accesorios",
        "Cámaras",
        "Periféricos",
        "Pantallas",
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
