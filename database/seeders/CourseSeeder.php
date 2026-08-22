<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\ProgrammingLanguage;
use App\Models\Quiz;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructor = User::query()->first() ?? User::factory()->create();

        $courses = [
            [
                'language' => 'javascript',
                'title' => 'JavaScript Essentials',
                'level' => 'beginner',
                'skills' => ['HTML5', 'CSS3'],
                'summary' => 'Learn the core building blocks of JavaScript, from variables and functions to the DOM and async code.',
            ],
            [
                'language' => 'typescript',
                'title' => 'TypeScript for JavaScript Developers',
                'level' => 'intermediate',
                'skills' => ['React'],
                'summary' => 'Add static types to your JavaScript projects and catch bugs before they ship.',
            ],
            [
                'language' => 'python',
                'title' => 'Python Programming Bootcamp',
                'level' => 'beginner',
                'skills' => ['Data Analysis', 'Problem Solving'],
                'summary' => 'Go from zero to confident with Python syntax, data structures, and scripting.',
            ],
            [
                'language' => 'python',
                'title' => 'Machine Learning with Python',
                'level' => 'advanced',
                'skills' => ['Machine Learning', 'Pandas', 'TensorFlow'],
                'summary' => 'Build and train real machine learning models using Python\'s data science stack.',
            ],
            [
                'language' => 'java',
                'title' => 'Java Fundamentals',
                'level' => 'beginner',
                'skills' => ['Object-Oriented Design'],
                'summary' => 'Master Java syntax, OOP principles, and the JVM ecosystem.',
            ],
            [
                'language' => 'c++',
                'title' => 'C++ for Competitive Programming',
                'level' => 'advanced',
                'skills' => ['Problem Solving'],
                'summary' => 'Sharpen your algorithmic thinking and low-level performance skills with C++.',
            ],
            [
                'language' => 'c#',
                'title' => 'C# and .NET Development',
                'level' => 'intermediate',
                'skills' => ['ASP.NET Core'],
                'summary' => 'Build modern web APIs and applications with C# and the .NET platform.',
            ],
            [
                'language' => 'go',
                'title' => 'Go for Backend Engineers',
                'level' => 'intermediate',
                'skills' => ['REST APIs', 'Microservices'],
                'summary' => 'Learn idiomatic Go and build fast, concurrent backend services.',
            ],
            [
                'language' => 'rust',
                'title' => 'Rust Fundamentals',
                'level' => 'advanced',
                'skills' => ['System Design'],
                'summary' => 'Understand ownership, borrowing, and how to write safe, fast systems code in Rust.',
            ],
            [
                'language' => 'ruby',
                'title' => 'Ruby on Rails Crash Course',
                'level' => 'beginner',
                'skills' => ['Ruby on Rails', 'Database Design'],
                'summary' => 'Ship a full web application quickly using Ruby on Rails conventions.',
            ],
            [
                'language' => 'php',
                'title' => 'Modern PHP with Laravel',
                'level' => 'intermediate',
                'skills' => ['Laravel', 'MySQL', 'REST APIs'],
                'summary' => 'Build robust, elegant web applications using PHP and the Laravel framework.',
            ],
            [
                'language' => 'swift',
                'title' => 'iOS App Development with Swift',
                'level' => 'intermediate',
                'skills' => ['iOS Development', 'SwiftUI'],
                'summary' => 'Design and build native iOS apps using Swift and SwiftUI.',
            ],
            [
                'language' => 'kotlin',
                'title' => 'Android Development with Kotlin',
                'level' => 'intermediate',
                'skills' => ['Android Development'],
                'summary' => 'Build modern Android applications using Kotlin and Jetpack libraries.',
            ],
            [
                'language' => 'sql',
                'title' => 'SQL for Data Professionals',
                'level' => 'beginner',
                'skills' => ['Database Design', 'PostgreSQL'],
                'summary' => 'Query, join, and shape relational data with confidence using SQL.',
            ],
            [
                'language' => 'dart',
                'title' => 'Cross-Platform Apps with Flutter',
                'level' => 'intermediate',
                'skills' => ['Flutter'],
                'summary' => 'Use Dart and Flutter to ship one codebase to iOS, Android, and the web.',
            ],
        ];

        $lessonOutline = [
            'Getting Started & Environment Setup',
            'Core Syntax and Fundamentals',
            'Working with Data Structures',
            'Functions, Control Flow & Error Handling',
            'Building a Real-World Mini Project',
            'Testing, Debugging & Best Practices',
        ];

        foreach ($courses as $courseData) {
            $language = ProgrammingLanguage::query()
                ->where('slug', Str::slug($courseData['language']))
                ->first();

            $course = Course::query()->updateOrCreate(
                ['slug' => Str::slug($courseData['title'])],
                [
                    'user_id' => $instructor->id,
                    'programming_language_id' => $language?->id,
                    'title' => $courseData['title'],
                    'description' => $courseData['summary'],
                    'thumbnail' => null,
                    'level' => $courseData['level'],
                    'duration_hours' => fake()->numberBetween(4, 30),
                    'price' => fake()->randomElement([0, 0, 19.99, 29.99, 49.99, 79.99]),
                    'is_published' => true,
                ],
            );

            $skillIds = Skill::query()
                ->whereIn('slug', array_map(fn ($s) => Str::slug($s), $courseData['skills']))
                ->pluck('id');

            if ($skillIds->isNotEmpty()) {
                $course->skills()->sync($skillIds);
            }

            foreach ($lessonOutline as $index => $lessonTitle) {
                Lesson::query()->updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'slug' => Str::slug($lessonTitle),
                    ],
                    [
                        'title' => $lessonTitle,
                        'content' => "This lesson walks through \"{$lessonTitle}\" for {$course->title}, with explanations, code walkthroughs, and hands-on exercises.",
                        'video_url' => null,
                        'order' => $index + 1,
                        'duration_minutes' => fake()->numberBetween(8, 35),
                    ],
                );
            }

            Quiz::query()->updateOrCreate(
                [
                    'course_id' => $course->id,
                    'title' => $course->title . ' Knowledge Check',
                ],
                [
                    'description' => 'Test what you\'ve learned so far in this course.',
                    'questions' => [
                        [
                            'question' => "What is a key benefit of learning {$course->title}?",
                            'options' => ['Better job prospects', 'It is fun', 'Both of the above', 'None of the above'],
                            'correct_index' => 2,
                        ],
                        [
                            'question' => 'Which practice helps you write more maintainable code?',
                            'options' => ['Writing tests', 'Ignoring errors', 'Skipping documentation', 'Avoiding version control'],
                            'correct_index' => 0,
                        ],
                        [
                            'question' => 'What should you do when you encounter a bug?',
                            'options' => ['Panic', 'Reproduce it, then debug systematically', 'Delete the code', 'Ignore it'],
                            'correct_index' => 1,
                        ],
                    ],
                    'passing_score' => 70,
                    'time_limit_minutes' => 15,
                ],
            );
        }
    }
}
