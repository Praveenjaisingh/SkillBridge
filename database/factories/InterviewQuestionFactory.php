<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewQuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question' => fake()->sentence() . '?',
            'answer' => fake()->paragraph(),
            'difficulty' => fake()->randomElement(['easy', 'medium', 'hard']),
            'category' => fake()->word(),
        ];
    }
}
