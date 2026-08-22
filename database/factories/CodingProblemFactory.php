<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CodingProblemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph(),
            'difficulty' => fake()->randomElement(['easy', 'medium', 'hard']),
            'sample_input' => '1 2',
            'sample_output' => '3',
            'constraints' => '1 <= n <= 100',
        ];
    }
}
