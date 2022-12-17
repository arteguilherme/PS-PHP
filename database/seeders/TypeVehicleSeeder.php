<?php

namespace Database\Seeders;

use App\Models\TypeVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_vehicles = [
            [
                'name' => 'Carros',
                'slug' => 'carros',
            ],
            [
                'name' => 'Motos',
                'slug' => 'motos',
            ],
            [
                'name' => 'Caminhões',
                'slug' => 'caminhoes',
            ],
        ];

        foreach ($type_vehicles as $type)
        {
            TypeVehicle::create($type);
        }
    }
}
