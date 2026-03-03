<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; // Importante para leer archivos

class ComunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		// 1. Leer el archivo JSON
		$json = File::get(database_path('seeders/data/comunas-regiones.json'));
		$data = json_decode($json, true);

		// 2. Iterar sobre las regiones
		foreach ($data['regions'] as $regionData) {
			// Convertimos a entero el número del JSON
			$regionId = (int) $regionData['number']; 
			$romanNumber = (string) $regionData['romanNumber'];
			$abbreviation = (string) $regionData['abbreviation'];
			
			DB::table('regions')->insert([
				'id'     => $regionId, // Forzamos el ID que viene del JSON
				'nombre' => $regionData['name'],
				'created_at' => now(),
				'updated_at' => now(),
				'romanNumber' => $romanNumber,
				'abbreviation' => $abbreviation
				
			]);

			// Insertamos comunas usando el $regionId que acabamos de definir
			foreach ($regionData['communes'] as $communeData) {
				DB::table('comunas')->insert([
					'region_id' => $regionId, 
					'nombre'    => $communeData['name'],
					'created_at' => now(),
					'updated_at' => now()
				]);
			}
		}
	}
}
