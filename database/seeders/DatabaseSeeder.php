<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProveedorSeeder::class);
        //$this->call(MarcaSeeder::class); //Se crearás desde Categoria
        $this->call(ColorSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(SubcategoriaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ColorProductoSeeder::class);
        $this->call(MedidaSeeder::class);
        $this->call(ColorMedidaSeeder::class);
        $this->call(MedidaProductoSeeder::class);
    }
}
