<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Contabilidad', 'Sistemas', 'Legal', 'Ventas', 'Compras', 'RRHH', 'Piso', 'Seguridad']),
            'active' => fake()->boolean(90),
        ];
    }
}
