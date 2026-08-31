<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Section;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'serial' => fake()->unique()->regexify('[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}'),
            'model' => fake()->regexify('[A-Z0-9]{10}'),
            'notes' => fake()->sentence(6),
            'type_id' => Type::inRandomOrder()->first()?->id ?? Type::factory(),
            'brand_id' => Brand::inRandomOrder()->first()?->id ?? Brand::factory(),
            'active' => $this->faker->boolean(90),
            'section_id' => Section::inRandomOrder()->first()?->id ?? Section::factory(),
        ];
    }
}
