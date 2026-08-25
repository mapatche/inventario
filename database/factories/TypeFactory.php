<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['computadora', 'mouse', 'teclado', 'monitor', 'inhalador']),
            'active' => fake()->boolean(100),
        ];
    }
}
