<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Frontend' => [
                'React', 'Vue.js', 'Angular', 'Next.js', 'Tailwind CSS', 'Redux', 'HTML5', 'CSS3', 'Responsive Design',
            ],
            'Backend' => [
                'Node.js', 'Laravel', 'Django', 'Express.js', 'Spring Boot', 'ASP.NET Core', 'Ruby on Rails', 'REST APIs', 'GraphQL',
            ],
            'Database' => [
                'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'SQLite', 'Elasticsearch', 'Database Design',
            ],
            'DevOps' => [
                'Docker', 'Kubernetes', 'CI/CD', 'AWS', 'Azure', 'Google Cloud', 'Terraform', 'Linux Administration', 'Nginx',
            ],
            'Mobile' => [
                'React Native', 'Flutter', 'iOS Development', 'Android Development', 'SwiftUI',
            ],
            'Data & AI' => [
                'Machine Learning', 'Data Analysis', 'Data Visualization', 'TensorFlow', 'PyTorch', 'Pandas', 'Natural Language Processing',
            ],
            'Tools & Practices' => [
                'Git', 'Testing & QA', 'Agile/Scrum', 'System Design', 'Object-Oriented Design', 'Microservices', 'Problem Solving',
            ],
        ];

        foreach ($skills as $category => $names) {
            foreach ($names as $name) {
                Skill::query()->updateOrCreate(
                    ['slug' => Str::slug($name)],
                    [
                        'name' => $name,
                        'category' => $category,
                        'description' => "Practical, job-ready proficiency in {$name}.",
                    ],
                );
            }
        }
    }
}
