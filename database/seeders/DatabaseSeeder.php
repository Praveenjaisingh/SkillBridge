<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Demo login: test@example.com / password
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // A few extra users so courses/jobs/etc. have variety of owners.
        User::factory(4)->create();

        $this->call([
            ProgrammingLanguageSeeder::class,
            SkillSeeder::class,
            CompanySeeder::class,
            CourseSeeder::class,
            CodingProblemSeeder::class,
            InterviewQuestionSeeder::class,
            JobSeeder::class,
        ]);
    }
}
