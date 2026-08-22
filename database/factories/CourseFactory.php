<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph(),
            'level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'duration_hours' => fake()->numberBetween(1, 40),
            'price' => fake()->randomFloat(2, 0, 200),
            'is_published' => fake()->boolean(),
        ];
    }
}
