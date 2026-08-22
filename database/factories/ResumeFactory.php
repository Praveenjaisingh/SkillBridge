<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->words(3, true),
            'file_path' => 'resumes/' . fake()->uuid() . '.pdf',
            'is_primary' => false,
        ];
    }
}
