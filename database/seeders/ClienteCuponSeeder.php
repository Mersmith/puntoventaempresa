<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\ClienteCupon;
use App\Models\Cupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClienteCuponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $clientes = Cliente::all()->pluck('id')->toArray();
        $cupones = Cupon::all()->pluck('id')->toArray();

        foreach (range(1, 50) as $index) {
            ClienteCupon::create([
                'cliente_id' => $faker->randomElement($clientes),
                'cupon_id' => $faker->randomElement($cupones),
                'uso' => $faker->boolean
            ]);
        }
    }
}
