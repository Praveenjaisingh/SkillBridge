<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'job_id' => Job::factory(),
            'user_id' => User::factory(),
            'cover_letter' => fake()->paragraph(),
            'status' => 'pending',
        ];
    }
}
