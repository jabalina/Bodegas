<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BodegaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
	public function definition()
	{
		return [
			'codigo' => $this->faker->unique()->bothify('B###'),
			'nombre' => $this->faker->company,
			'calle' => $this->faker->streetName,
			'numero' => $this->faker->buildingNumber,
			'comuna_id' => 1, // Asegúrate de tener al menos una comuna creada
			'dotacion' => $this->faker->numberBetween(5, 50),
			'estado' => $this->faker->randomElement(['Activa', 'Inactiva']),
		];
	}
}
