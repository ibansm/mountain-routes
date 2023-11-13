<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incidencia>
 */
class IncidenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'historicos_id'=> $this->faker->numberBetween(1,30),
            'tipo'=>$this->faker->randomElement(['derrumbe','piedra','estado_fuente','hundimiento']),
            'coordenada' => $this->faker->randomFloat(2, -999999, 999999),
            'estado'=>$this->faker->boolean(),
        ];
    }
}
