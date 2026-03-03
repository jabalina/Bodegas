<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EncargadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
	public function definition()
	{
		return [
			'run' => $this->faker->unique()->numerify('########-#'),
			'nombre' => $this->faker->firstName,
			'primer_apellido' => $this->faker->lastName,
			'segundo_apellido' => $this->faker->lastName,
			'telefono' => $this->faker->phoneNumber,
		];
	}
}
