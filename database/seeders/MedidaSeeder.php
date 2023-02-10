<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Builder;

class MedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = Producto::whereHas('subcategoria', function (Builder $query) {
            $query->where('tiene_color', true)
                ->where('tiene_medida', true);
        })->get();

        $medidas = ['Ø98x10', 'Ø98x12', 'Ø98x14', 'Ø98x16', 'Ø98x18', 'Ø98x20'];

        foreach ($productos as $producto) {

            foreach ($medidas as $medida) {
                $producto->medidas()->create([
                    'nombre' => $medida
                ]);
            }
        }
    }
}
