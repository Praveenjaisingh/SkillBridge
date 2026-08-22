<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookmarkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'bookmarkable_id' => Job::factory(),
            'bookmarkable_type' => Job::class,
        ];
    }
}
