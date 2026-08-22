<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'title' => fake()->jobTitle(),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph(),
            'requirements' => fake()->paragraph(),
            'location' => fake()->city(),
            'job_type' => fake()->randomElement(['full-time', 'part-time', 'contract', 'internship', 'remote']),
            'experience_level' => fake()->randomElement(['junior', 'mid', 'senior']),
            'salary_min' => 60000,
            'salary_max' => 100000,
            'is_active' => true,
        ];
    }
}
