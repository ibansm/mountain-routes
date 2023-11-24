<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ruta>
 */
class RutaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        $kenduSlas = [
            "type"=> "Feature",
            "geometry" => [
                        "type" => [
                                "Point",
                                "coordinates"=> [125.6, 10.1],
                                "properties" => ["name"=> "Dinagat Islands"]
                                ]
                        ]
            ];
        
        return [          
            'nombre'=> $this->faker->unique()->sentence(),
            'descripcion'=>$this->faker->unique()->text(250),
            'longitud'=> $this->faker->randomFloat(1, 10, 200),
            'tiempo'=> $this->faker->numberBetween(3600, 7000),
            'ciudad' => $this->faker->city(),
            'fecha_creada' => $this->faker->dateTimeBetween(date('2023-01-01'), now()),
            'fecha_realizada'=> $this->faker->dateTimeBetween(date('2023-01-01'), now()),
            'coordenadas'=> $kenduSlas,
            'dificultad' => $this->faker->randomElement(['baja','media','alta']),
            'foto_perfil' => $this->faker->imageUrl(),
            'usuarios_id' => $this->faker->numberBetween(1,30)
        ];
    }
}
