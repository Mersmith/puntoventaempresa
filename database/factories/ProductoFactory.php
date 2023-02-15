<?php

namespace Database\Factories;

use App\Models\Imagen;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\Storage;
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
        $nombre = $this->faker->unique()->sentence(2);

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

    /*public function configure()
    {
        return $this->afterCreating(function (Producto $producto) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                $imagen = new Imagen();
                $imagen->imagen_ruta = $this->faker->imageUrl(640, 480, 'food');
                $producto->imagenes()->save($imagen);

                $fileContents = file_get_contents($imagen->imagen_ruta);
                $fileName = 'producto-' . $producto->id . '-imagen-' . $imagen->id . '.jpg';
                Storage::disk('public')->put('productos/' . $fileName, $fileContents);
            }
        });
    }

    public function configure()
    {
        $this->define(Imagen::class, function ($faker) {
            $imagen = new Imagen();
            $imagen->imagen_ruta = 'images/productos/' . Str::random(10) . '.jpg'; // Establecer la ruta de la carpeta de almacenamiento local
            $imagen->save();

            $fileContents = file_get_contents($faker->imageUrl(640, 480, 'food'));
            Storage::disk('public')->put($imagen->imagen_ruta, $fileContents);

            return $imagen;
        });
    }

    public function afterCreating(Producto $producto)
    {
        $cantidad_imagenes = rand(1, 5);
        for ($i = 0; $i < $cantidad_imagenes; $i++) {
            $producto->imagenes()->save(Imagen::factory()->make());
        }
    }*/
}
