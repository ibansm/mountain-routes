<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FotosRuta>
 */
class FotosRutaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=> $this->faker->sentence(),
            'data' => $this->faker->imageUrl(),
            'coordenadas' => $this->faker->randomFloat(2,2,2),
            'rutas_id' => $this->faker->numberBetween(1,30)
        ];
    }
}
