<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Pfizzer', 'DELL', 'HP', 'Lenovo', 'Alienware']),
            'active' => fake()->boolean(100)
        ];
    }
}
