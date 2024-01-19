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


        $kenduSlas ="LatLng(43.507562, -5.373383),LatLng(43.506317, -5.372009),LatLng(43.488136, -5.369433),LatLng(43.487264, -5.350886),LatLng(43.490004, -5.345391),LatLng(43.492744, -5.347108),LatLng(43.495359, -5.35226),LatLng(43.498348, -5.348825),LatLng(43.498721, -5.343502),LatLng(43.497102, -5.337148),LatLng(43.49374, -5.335087),LatLng(43.491, -5.336804),LatLng(43.486517, -5.332683),LatLng(43.487762, -5.326157),LatLng(43.492993, -5.322894),LatLng(43.503079, -5.324783),LatLng(43.510176, -5.32942),LatLng(43.516774, -5.328905),LatLng(43.521006, -5.32547),LatLng(43.524741, -5.34728),LatLng(43.522874, -5.353634),LatLng(43.522998, -5.368746),LatLng(43.525487, -5.372867),LatLng(43.528101, -5.373383),LatLng(43.531213, -5.37613),LatLng(43.53283, -5.378363)";
        
        return [          
            'nombre'=> $this->faker->unique()->sentence(),
            'descripcion'=>$this->faker->unique()->text(250),
            'longitud'=> $this->faker->randomFloat(1, 10, 200),
            'duracion'=> $this->faker->numberBetween(0, 7000),
            'ninos'=> $this->faker->boolean(),
            'ciudad' => $this->faker->city(),
            'coordenadas'=> $kenduSlas,
            'dificultad' => $this->faker->randomElement(['baja','media','alta']),
            'foto_perfil' => $this->faker->imageUrl(),
            'usuarios_id' => $this->faker->numberBetween(1,30)
        ];
    }
}
