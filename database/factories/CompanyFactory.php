<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company(),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->catchPhrase(),
            'website' => fake()->url(),
            'logo' => null,
            'location' => fake()->city(),
            'industry' => fake()->randomElement(['Tech', 'Finance', 'Healthcare', 'Retail']),
        ];
    }
}
