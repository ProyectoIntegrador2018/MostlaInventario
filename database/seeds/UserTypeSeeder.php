<?php

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    protected $types = [
        "Usuario",
        "Coordinador",
        "Administrador",
        "Administrador General",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $type) {
            UserType::create(['title'=>$type]);
        }
    }
}
