<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['computadora', 'mouse', 'teclado', 'monitor', 'Inhalador']),
            'active' => fake()->boolean(100)
        ];
    }
}
