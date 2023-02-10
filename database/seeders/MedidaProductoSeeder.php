<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Builder;

class MedidaProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = Producto::whereHas('subcategoria', function (Builder $query) {
            $query->where('tiene_color', 0)
                ->where('tiene_medida', 1);
        })->get();

        foreach ($productos as $producto) {
            $producto->medida_producto()->attach([
                1 => [
                    'stock' => 10
                ],
                2 => [
                    'stock' => 20
                ],
                3 => [
                    'stock' => 30
                ],
                4 => [
                    'stock' => 40
                ]
            ]);
        }
    }
}
