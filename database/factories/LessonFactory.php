<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => fake()->sentence(4),
            'slug' => fake()->unique()->slug(),
            'content' => fake()->paragraphs(3, true),
            'order' => fake()->numberBetween(1, 10),
            'duration_minutes' => fake()->numberBetween(5, 60),
        ];
    }
}
