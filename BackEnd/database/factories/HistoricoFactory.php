<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Historico>
 */
class HistoricoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_actualizada' => $this->faker->dateTimeBetween(date('2023-01-01'), now()),
            'fecha_realizada' =>  $this->faker->dateTimeBetween(date('2023-01-01'), now()),
            'rutas_id' => $this->faker->numberBetween(1,30)
        ];
    }
}
