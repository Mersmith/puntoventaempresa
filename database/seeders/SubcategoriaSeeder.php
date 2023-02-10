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
            [
                'categoria_id' => 1,
                'nombre' => 'Sin Variacion 2',
                'slug' => Str::slug('Sin Variacion 2'),
            ],
            /*MEDIDA*/
            [
                'categoria_id' => 2,
                'nombre' => 'Variacion Medida',
                'slug' => Str::slug('Variacion Medida'),
                'tiene_medida' => true
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Variacion Medida 2',
                'slug' => Str::slug('Variacion Medida 2'),
                'tiene_medida' => true
            ],
            /*COLOR*/
            [
                'categoria_id' => 3,
                'nombre' => 'Variacion Color',
                'slug' => Str::slug('Variacion Color'),
                'tiene_color' => true
            ],
            [
                'categoria_id' => 3,
                'nombre' => 'Variacion Color 2',
                'slug' => Str::slug('Variacion Color 2'),
                'tiene_color' => true
            ],
            /*MEDIDA Y COLOR*/
            [
                'categoria_id' => 4,
                'nombre' => 'Variacion Medida y Color',
                'slug' => Str::slug('Variacion Medida y Color'),
                'tiene_medida' => true,
                'tiene_color' => true
            ],
            [
                'categoria_id' => 4,
                'nombre' => 'Variacion Medida y Color 2',
                'slug' => Str::slug('Variacion Medida y Color 2'),
                'tiene_medida' => true,
                'tiene_color' => true
            ],

        ];

        foreach ($subcategorias as $subcategoria) {
            Subcategoria::factory(1)->create($subcategoria);
        }
    }
}
