<?php

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    protected $campus = [
        'Aguascalientes',
        'Central de Veracruz',
        'Chiapas',
        'Chihuahua',
        'Ciudad de México',
        'Ciudad Juarez',
        'Ciudad Obregón',
        'Cuernavaca',
        'Estado de México',
        'Guadalajara',
        'Hidalgo',
        'Irapuato',
        'Laguna',
        'León',
        'Monterrey',
        'Morelia',
        'Puebla',
        'Querétaro',
        'Saltillo',
        'San Luis Potosí',
        'Santa Fe',
        'Sinaloa',
        'Sonora Norte',
        'Tampico',
        'Toluca',
        'Zacatecas',
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
