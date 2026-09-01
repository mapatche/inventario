<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->numerify('686-###-####'),
            'email' => $this->faker->unique()->safeEmail(),
            'active' => $this->faker->boolean(90),
            'department_id' => Department::inRandomOrder()->first()?->id ?? Department::factory(),
        ];
    }
}
