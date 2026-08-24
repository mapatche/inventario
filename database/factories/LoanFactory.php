<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'notes' => fake()->sentence(6),
            'active' => fake()->boolean(95),
            'employee_id' => Employee::inRandomOrder()->first()->id ?? Employee::factory(),
            'item_id' => Item::inRandomOrder()->first()->id ?? Item::factory(),
        ];
    }
}
