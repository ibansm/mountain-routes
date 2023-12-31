<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FotosRuta;
use App\Models\Historico;
use App\Models\Incidencia;
use App\Models\Ruta;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            // Crear registros de prueba
            User::factory(30)->create();
            Ruta::factory(30)->create();
            FotosRuta::factory(30)->create();
    }
}
