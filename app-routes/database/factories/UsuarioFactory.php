<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName, 
            'nombre'=> $this->faker->name,
            'apellidos'=> $this->faker->lastName,
            'email'=> $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(),
            'edad'=> $this->faker->optional()->numberBetween(10,99)
        ];
    }
}
