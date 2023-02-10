<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'nombre' => 'Equipos intraorales',
                'slug' => Str::slug('Equipos intraorales'),
                'icono' => '<i class="fas fa-mobile-alt"></i>',
                'descripcion' => 'Sint velit eveniet.'
            ],
            [
                'nombre' => 'Equipos extraorales',
                'slug' => Str::slug('Equipos extraorales'),
                'icono' => '<i class="fas fa-mobile-alt"></i>',
                'descripcion' => 'Sint velit eveniet.'
            ],
            [
                'nombre' => 'Materiales',
                'slug' => Str::slug('Materiales'),
                'icono' => '<i class="fas fa-mobile-alt"></i>',
                'descripcion' => 'Sint velit eveniet.'
            ],
            [
                'nombre' => 'Implantes',
                'slug' => Str::slug('Implantes'),
                'icono' => '<i class="fas fa-mobile-alt"></i>',
                'descripcion' => 'Sint velit eveniet.'
            ],
        ];

        foreach ($categorias as $categoria) {            

            $categoriaID = Categoria::factory(1)->create($categoria)->first();

            $marcas = Marca::factory(4)->create();

            //attach llena la tabla intermedia
            foreach ($marcas as $marca) {
                $marca->categorias()->attach($categoriaID->id);
            }
        }
    }
    
}
