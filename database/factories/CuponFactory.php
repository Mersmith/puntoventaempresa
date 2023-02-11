<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cupon>
 */
class CuponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $codigo = $this->faker->unique()->word();

        $tipo = $this->faker->randomElement(['fijo', 'porcentaje']);
        
        
        if ($tipo == 'fijo' ) {
            $descuento = $this->faker->randomElement([50, 100, 200, 300]);
        } else {
            $descuento = $this->faker->randomElement([5, 8, 10, 15]);
        }

        return [          
            'codigo' => $codigo,
            'tipo' => $tipo,
            'descuento' => $descuento,
            'carrito_monto' => $this->faker->randomElement([1000, 1200, 1400, 1500]),
            'fecha_expiracion' => $this->faker->dateTimeInInterval('-3 days', '+1 months'),
            //'fecha_expiracion' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
