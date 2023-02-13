<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Obtener los departamentos
        $departamentos = DB::table('departamentos')->get();

        // Crear direcciones para cada cliente
        $clientes = DB::table('clientes')->pluck('id');

        foreach ($clientes as $cliente_id) {

            for ($i = 0; $i < 2; $i++) {
                // Obtener un departamento al azar
                $departamento = $departamentos[array_rand($departamentos->toArray())];

                // Hacer lo mismo con las provincias y los distritos
                $provincias = DB::table('provincias')
                    ->where('departamento_id', $departamento->id)
                    ->get();

                $provincia = $provincias[array_rand($provincias->toArray())];

                $distritos = DB::table('distritos')
                    ->where('provincia_id', $provincia->id)
                    ->get();

                $distrito = $distritos[array_rand($distritos->toArray())];

                DB::table('direccions')->insert([
                    'cliente_id' => $cliente_id,
                    'departamento_id' => $departamento->id,
                    'provincia_id' => $provincia->id,
                    'distrito_id' => $distrito->id,
                    'nombres' => $faker->name,
                    'celular' => $faker->phoneNumber,
                    'direccion' => $faker->address,
                    'referencia' => $faker->text,
                    'departamento_nombre' => $departamento->nombre,
                    'provincia_nombre' => $provincia->nombre,
                    'distrito_nombre' => $distrito->nombre,
                    'codigo_postal' => $faker->postcode,
                    'posicion' => $i,
                ]);
            }
        }
    }
}
