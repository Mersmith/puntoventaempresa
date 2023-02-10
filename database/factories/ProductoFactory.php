<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subcategoria;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nombre = $this->faker->sentence(2);

        $subcategoria = Subcategoria::all()->random();
        $categoria = $subcategoria->categoria;
        $marca = $categoria->marcas->random();
        $proveedor = Proveedor::all()->random();

        if ($subcategoria->tiene_color) {
            $stock = null;
        } else {
            $stock = 15;
        }

        return [
            'subcategoria_id' => $subcategoria->id,
            'marca_id' => $marca->id,
            'proveedor_id' => $proveedor->id,
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'sku' => $this->faker->unique()->randomNumber(),
            'precio_venta' => $this->faker->randomElement([1000, 1200, 1400, 1500]),
            'precio_real' => $this->faker->randomElement([1500, 2000, 3000, 5000]),
            'stock_total' => $stock,
            'descripcion' => $this->faker->text(),
            'informacion' => $this->faker->text(),
            'puntos_ganar' => $this->faker->randomElement([10, 20, 30, 40, 50]),
            'puntos_canjeo' => $this->faker->randomElement([100, 200, 300, 400, 500]),
            'link_video' => "https://www.youtube.com/embed/iQ7iu-zkh0o",
            'incluye_igv' => false,
            'tiene_detalle' => false,
            'estado' => $this->faker->randomElement([0, 1]),
            'visitas' => $this->faker->randomNumber(),
        ];
    }
}
