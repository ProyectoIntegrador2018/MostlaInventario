<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    protected $tags = [
        "Móviles",
        "Pantallas",
        "Accesorios",
        "Perifericos",
        "Consolas",
        "Baterías",
        "Resistente al Agua",
        "Windows",
        "OSX",
        "Linux",
        "Android",
        "iOS",
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
