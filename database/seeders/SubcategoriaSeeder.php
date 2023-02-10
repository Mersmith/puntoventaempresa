<?php

namespace Database\Seeders;

use App\Models\Subcategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategorias = [
            /*SIN VARIACION*/
            [
                'categoria_id' => 1,
                'nombre' => 'Sin Variacion',
                'slug' => Str::slug('Sin Variacion'),
            ],
            /*MEDIDA*/
            [
                'categoria_id' => 2,
                'nombre' => 'Variacion Medida',
                'slug' => Str::slug('Variacion Medida'),
                'tiene_medida' => true
            ],
            /*COLOR*/
            [
                'categoria_id' => 3,
                'nombre' => 'Variacion Color',
                'slug' => Str::slug('Variacion Color'),
                'tiene_color' => true
            ],
            /*MEDIDA Y COLOR*/
            [
                'categoria_id' => 4,
                'nombre' => 'ZirconVariacion Medida y Color',
                'slug' => Str::slug('Variacion Medida y Color'),
                'tiene_medida' => true,
                'tiene_color' => true
            ],

        ];

        foreach ($subcategorias as $subcategoria) {
            Subcategoria::create($subcategoria);
        }
    }
}
