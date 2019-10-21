<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    protected $tags = [
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
        foreach ($this->tags as $tag) {
            Tag::create(['name'=>$tag]);
        }
    }
}
