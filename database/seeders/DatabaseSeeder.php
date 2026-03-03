<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call([
			//RegionesSeeder::class, // Es mejor cargar regiones primero
			ComunasSeeder::class,  // Luego las comunas que dependen de las regiones
			//EncargadoSeeder::class,
			//BodegaSeeder::class,
		]);
		// 1. Crear 10 encargados
		$encargados = \App\Models\Encargado::factory()->count(10)->create();

		// 2. Crear 10 bodegas
		\App\Models\Bodega::factory()->count(10)->create()->each(function ($bodega) use ($encargados) {
			// A cada bodega, le asignamos 2 o 3 encargados al azar
			$bodega->encargados()->attach(
				$encargados->random(rand(1, 3))->pluck('id')->toArray()
			);
		});
    }
}
