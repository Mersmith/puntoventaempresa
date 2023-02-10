<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medida;

class ColorMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medidas = Medida::all();
        foreach ($medidas as $itemMedida) {
            $itemMedida->colores()->attach(([
                1 => ['stock' => 10],
                2 => ['stock' => 20],
                3 => ['stock' => 30],
                4 => ['stock' => 40]
            ]));
        }
    }
}
