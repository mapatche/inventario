<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => substr(fake()->unique()->jobTitle(), 0, 25),
            'active' => fake()->boolean(90),
        ];
    }
}
