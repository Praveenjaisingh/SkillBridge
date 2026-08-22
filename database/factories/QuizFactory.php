<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'questions' => [
                ['question' => fake()->sentence() . '?', 'options' => ['A', 'B', 'C'], 'correct_index' => 0],
            ],
            'passing_score' => 60,
            'time_limit_minutes' => 15,
        ];
    }
}
