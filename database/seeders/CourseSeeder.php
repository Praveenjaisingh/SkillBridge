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
                'learning_outcomes' => [
                    'Write and debug JavaScript using variables, functions, and control flow',
                    'Manipulate the DOM to build interactive web pages',
                    'Handle asynchronous operations with promises and async/await',
                    'Understand common array and object methods used in real projects',
                ],
                'prerequisites' => 'No prior programming experience required — basic familiarity with HTML and CSS is helpful but not mandatory.',
                'target_audience' => 'Aspiring web developers and beginners with no JavaScript experience',
            ],
            [
                'language' => 'typescript',
                'title' => 'TypeScript for JavaScript Developers',
                'level' => 'intermediate',
                'skills' => ['React'],
                'summary' => 'Add static types to your JavaScript projects and catch bugs before they ship.',
                'learning_outcomes' => [
                    'Convert existing JavaScript codebases to TypeScript incrementally',
                    'Use interfaces, generics, and union types to model real-world data',
                    'Configure the TypeScript compiler for different project setups',
                    'Catch type-related bugs at compile time instead of runtime',
                ],
                'prerequisites' => 'Solid working knowledge of JavaScript (variables, functions, objects, arrays) is required.',
                'target_audience' => 'JavaScript developers who want stronger tooling and fewer runtime bugs',
            ],
            [
                'language' => 'python',
                'title' => 'Python Programming Bootcamp',
                'level' => 'beginner',
                'skills' => ['Data Analysis', 'Problem Solving'],
                'summary' => 'Go from zero to confident with Python syntax, data structures, and scripting.',
                'learning_outcomes' => [
                    'Write clean, idiomatic Python using lists, dictionaries, and functions',
                    'Read and write files, and handle common exceptions gracefully',
                    'Automate everyday tasks with simple Python scripts',
                    'Understand the basics of object-oriented programming in Python',
                ],
                'prerequisites' => 'No prior programming experience required.',
                'target_audience' => 'Complete beginners looking for a practical first programming language',
            ],
            [
                'language' => 'python',
                'title' => 'Machine Learning with Python',
                'level' => 'advanced',
                'skills' => ['Machine Learning', 'Pandas', 'TensorFlow'],
                'summary' => 'Build and train real machine learning models using Python\'s data science stack.',
                'learning_outcomes' => [
                    'Clean and explore datasets using Pandas and NumPy',
                    'Train, evaluate, and tune classification and regression models',
                    'Build a basic neural network with TensorFlow',
                    'Avoid common pitfalls like overfitting and data leakage',
                ],
                'prerequisites' => 'Comfortable Python programming skills and basic statistics (mean, variance, probability) are required.',
                'target_audience' => 'Python developers moving into data science and machine learning roles',
            ],
            [
                'language' => 'java',
                'title' => 'Java Fundamentals',
                'level' => 'beginner',
                'skills' => ['Object-Oriented Design'],
                'summary' => 'Master Java syntax, OOP principles, and the JVM ecosystem.',
                'learning_outcomes' => [
                    'Write Java programs using classes, objects, and interfaces',
                    'Apply core OOP principles: encapsulation, inheritance, and polymorphism',
                    'Handle exceptions and work with Java\'s standard collections',
                    'Understand how the JVM compiles and runs Java code',
                ],
                'prerequisites' => 'No prior programming experience required.',
                'target_audience' => 'Beginners and developers preparing for enterprise or Android development',
            ],
            [
                'language' => 'c++',
                'title' => 'C++ for Competitive Programming',
                'level' => 'advanced',
                'skills' => ['Problem Solving'],
                'summary' => 'Sharpen your algorithmic thinking and low-level performance skills with C++.',
                'learning_outcomes' => [
                    'Implement classic data structures and algorithms efficiently in C++',
                    'Use the STL (vectors, maps, sets, priority queues) fluently under time pressure',
                    'Analyze time and space complexity to choose the right approach',
                    'Debug tricky edge cases quickly during timed contests',
                ],
                'prerequisites' => 'Working knowledge of C++ syntax and basic data structures (arrays, linked lists) is expected.',
                'target_audience' => 'Developers preparing for coding interviews or competitive programming contests',
            ],
            [
                'language' => 'c#',
                'title' => 'C# and .NET Development',
                'level' => 'intermediate',
                'skills' => ['ASP.NET Core'],
                'summary' => 'Build modern web APIs and applications with C# and the .NET platform.',
                'learning_outcomes' => [
                    'Build RESTful APIs using ASP.NET Core',
                    'Apply dependency injection and middleware patterns idiomatically',
                    'Work with Entity Framework Core for data access',
                    'Write and run unit tests for a .NET application',
                ],
                'prerequisites' => 'Basic C# syntax and object-oriented programming concepts are recommended.',
                'target_audience' => 'Developers building web services on the .NET platform',
            ],
            [
                'language' => 'go',
                'title' => 'Go for Backend Engineers',
                'level' => 'intermediate',
                'skills' => ['REST APIs', 'Microservices'],
                'summary' => 'Learn idiomatic Go and build fast, concurrent backend services.',
                'learning_outcomes' => [
                    'Write idiomatic Go using goroutines and channels for concurrency',
                    'Build and test REST APIs using the standard library and popular routers',
                    'Structure a Go project for maintainability at scale',
                    'Deploy a Go service as a small, fast container image',
                ],
                'prerequisites' => 'Some backend development experience in any language is recommended.',
                'target_audience' => 'Backend engineers building high-throughput, concurrent services',
            ],
            [
                'language' => 'rust',
                'title' => 'Rust Fundamentals',
                'level' => 'advanced',
                'skills' => ['System Design'],
                'summary' => 'Understand ownership, borrowing, and how to write safe, fast systems code in Rust.',
                'learning_outcomes' => [
                    'Explain and apply Rust\'s ownership, borrowing, and lifetime rules',
                    'Write safe concurrent code without data races',
                    'Use Rust\'s error handling model (Result and Option) idiomatically',
                    'Build and test a small command-line application in Rust',
                ],
                'prerequisites' => 'Prior experience with a systems language (C or C++) or strong general programming skills is recommended.',
                'target_audience' => 'Developers who want memory safety and performance without a garbage collector',
            ],
            [
                'language' => 'ruby',
                'title' => 'Ruby on Rails Crash Course',
                'level' => 'beginner',
                'skills' => ['Ruby on Rails', 'Database Design'],
                'summary' => 'Ship a full web application quickly using Ruby on Rails conventions.',
                'learning_outcomes' => [
                    'Scaffold a full-featured web application following Rails conventions',
                    'Model relational data using ActiveRecord associations and migrations',
                    'Build forms, validations, and authentication flows',
                    'Deploy a Rails application to a production environment',
                ],
                'prerequisites' => 'Basic Ruby syntax is helpful but covered briefly at the start of the course.',
                'target_audience' => 'Developers who want to ship web applications quickly with strong conventions',
            ],
            [
                'language' => 'php',
                'title' => 'Modern PHP with Laravel',
                'level' => 'intermediate',
                'skills' => ['Laravel', 'MySQL', 'REST APIs'],
                'summary' => 'Build robust, elegant web applications using PHP and the Laravel framework.',
                'learning_outcomes' => [
                    'Build CRUD applications using Laravel\'s routing, controllers, and Eloquent ORM',
                    'Design and run database migrations and seeders',
                    'Implement authentication and authorization with Laravel\'s built-in tools',
                    'Build and consume a REST API with Laravel',
                ],
                'prerequisites' => 'Basic PHP syntax and familiarity with relational databases are recommended.',
                'target_audience' => 'PHP developers who want to build maintainable applications with a modern framework',
            ],
            [
                'language' => 'swift',
                'title' => 'iOS App Development with Swift',
                'level' => 'intermediate',
                'skills' => ['iOS Development', 'SwiftUI'],
                'summary' => 'Design and build native iOS apps using Swift and SwiftUI.',
                'learning_outcomes' => [
                    'Build declarative user interfaces using SwiftUI',
                    'Manage app state and navigation across multiple screens',
                    'Fetch and display data from a network API',
                    'Package and prepare an app for the App Store',
                ],
                'prerequisites' => 'Basic Swift syntax and a Mac with Xcode installed are required.',
                'target_audience' => 'Developers building native applications for iOS and iPadOS',
            ],
            [
                'language' => 'kotlin',
                'title' => 'Android Development with Kotlin',
                'level' => 'intermediate',
                'skills' => ['Android Development'],
                'summary' => 'Build modern Android applications using Kotlin and Jetpack libraries.',
                'learning_outcomes' => [
                    'Build Android UIs using Jetpack Compose',
                    'Manage app lifecycle and state with ViewModel and LiveData/StateFlow',
                    'Persist data locally using Room',
                    'Call network APIs and handle asynchronous work with coroutines',
                ],
                'prerequisites' => 'Basic Kotlin syntax and Android Studio installed are recommended.',
                'target_audience' => 'Developers building native Android applications',
            ],
            [
                'language' => 'sql',
                'title' => 'SQL for Data Professionals',
                'level' => 'beginner',
                'skills' => ['Database Design', 'PostgreSQL'],
                'summary' => 'Query, join, and shape relational data with confidence using SQL.',
                'learning_outcomes' => [
                    'Write SELECT queries with filtering, sorting, and aggregation',
                    'Combine data across tables using different types of joins',
                    'Design normalized schemas for relational databases',
                    'Write subqueries and window functions for advanced reporting',
                ],
                'prerequisites' => 'No prior database experience required.',
                'target_audience' => 'Analysts, engineers, and anyone who needs to query relational data',
            ],
            [
                'language' => 'dart',
                'title' => 'Cross-Platform Apps with Flutter',
                'level' => 'intermediate',
                'skills' => ['Flutter'],
                'summary' => 'Use Dart and Flutter to ship one codebase to iOS, Android, and the web.',
                'learning_outcomes' => [
                    'Build responsive UIs using Flutter\'s widget system',
                    'Manage application state using a state management approach (Provider/Riverpod)',
                    'Navigate between screens and pass data between them',
                    'Package and ship a Flutter app to both iOS and Android',
                ],
                'prerequisites' => 'Basic Dart syntax is covered at the start; prior mobile development experience is helpful but not required.',
                'target_audience' => 'Developers who want to target multiple platforms from a single codebase',
            ],
        ];

        $lessonOutline = [
            [
                'title' => 'Getting Started & Environment Setup',
                'takeaways' => [
                    'Have a working local environment (editor, compiler/interpreter, and version control) ready to go',
                    'Understand how to run and test a simple program from the command line',
                    'Know where to find official documentation when you get stuck',
                ],
            ],
            [
                'title' => 'Core Syntax and Fundamentals',
                'takeaways' => [
                    'Comfortably declare variables, use basic types, and write simple expressions',
                    'Understand the difference between statements and expressions in this language',
                    'Recognize common syntax mistakes before they cause runtime errors',
                ],
            ],
            [
                'title' => 'Working with Data Structures',
                'takeaways' => [
                    'Choose the right built-in data structure (list, map, set, etc.) for a given problem',
                    'Understand the time complexity trade-offs between common data structures',
                    'Practice iterating, filtering, and transforming collections of data',
                ],
            ],
            [
                'title' => 'Functions, Control Flow & Error Handling',
                'takeaways' => [
                    'Write reusable functions with clear inputs and outputs',
                    'Use conditionals and loops to control program flow confidently',
                    'Anticipate and handle errors instead of letting programs crash unexpectedly',
                ],
            ],
            [
                'title' => 'Building a Real-World Mini Project',
                'takeaways' => [
                    'Break a real problem down into smaller, manageable pieces',
                    'Apply everything learned so far in a single connected project',
                    'Experience the full loop of writing, running, and fixing code',
                ],
            ],
            [
                'title' => 'Testing, Debugging & Best Practices',
                'takeaways' => [
                    'Write simple automated tests to catch regressions early',
                    'Use a debugger or print-based debugging to isolate issues systematically',
                    'Follow naming, formatting, and structuring conventions that keep code maintainable',
                ],
            ],
        ];

        // Short, language-appropriate snippets for the two most code-heavy lesson stages.
        $codeExamplesByLanguage = [
            'javascript' => ['syntax' => "let score = 10;\nconst name = 'Ada';\nconsole.log(`\${name} scored \${score}`);", 'data' => "const scores = [10, 20, 30];\nconst total = scores.reduce((sum, s) => sum + s, 0);\nconsole.log(total); // 60"],
            'typescript' => ['syntax' => "let score: number = 10;\nconst name: string = 'Ada';\nconsole.log(`\${name} scored \${score}`);", 'data' => "const scores: number[] = [10, 20, 30];\nconst total: number = scores.reduce((sum, s) => sum + s, 0);\nconsole.log(total); // 60"],
            'python' => ['syntax' => "score = 10\nname = 'Ada'\nprint(f\"{name} scored {score}\")", 'data' => "scores = [10, 20, 30]\ntotal = sum(scores)\nprint(total)  # 60"],
            'java' => ['syntax' => "int score = 10;\nString name = \"Ada\";\nSystem.out.println(name + \" scored \" + score);", 'data' => "List<Integer> scores = List.of(10, 20, 30);\nint total = scores.stream().mapToInt(Integer::intValue).sum();\nSystem.out.println(total); // 60"],
            'c++' => ['syntax' => "int score = 10;\nstd::string name = \"Ada\";\nstd::cout << name << \" scored \" << score << std::endl;", 'data' => "std::vector<int> scores = {10, 20, 30};\nint total = std::accumulate(scores.begin(), scores.end(), 0);\nstd::cout << total; // 60"],
            'c#' => ['syntax' => "int score = 10;\nstring name = \"Ada\";\nConsole.WriteLine($\"{name} scored {score}\");", 'data' => "var scores = new List<int> { 10, 20, 30 };\nvar total = scores.Sum();\nConsole.WriteLine(total); // 60"],
            'go' => ['syntax' => "score := 10\nname := \"Ada\"\nfmt.Printf(\"%s scored %d\\n\", name, score)", 'data' => "scores := []int{10, 20, 30}\ntotal := 0\nfor _, s := range scores {\n    total += s\n}\nfmt.Println(total) // 60"],
            'rust' => ['syntax' => "let score = 10;\nlet name = \"Ada\";\nprintln!(\"{} scored {}\", name, score);", 'data' => "let scores = vec![10, 20, 30];\nlet total: i32 = scores.iter().sum();\nprintln!(\"{}\", total); // 60"],
            'ruby' => ['syntax' => "score = 10\nname = 'Ada'\nputs \"#{name} scored #{score}\"", 'data' => "scores = [10, 20, 30]\ntotal = scores.sum\nputs total # 60"],
            'php' => ['syntax' => "\$score = 10;\n\$name = 'Ada';\necho \"{\$name} scored {\$score}\";", 'data' => "\$scores = [10, 20, 30];\n\$total = array_sum(\$scores);\necho \$total; // 60"],
            'swift' => ['syntax' => "let score = 10\nlet name = \"Ada\"\nprint(\"\\(name) scored \\(score)\")", 'data' => "let scores = [10, 20, 30]\nlet total = scores.reduce(0, +)\nprint(total) // 60"],
            'kotlin' => ['syntax' => "val score = 10\nval name = \"Ada\"\nprintln(\"\$name scored \$score\")", 'data' => "val scores = listOf(10, 20, 30)\nval total = scores.sum()\nprintln(total) // 60"],
            'sql' => ['syntax' => "SELECT name, score FROM players WHERE score > 5;", 'data' => "SELECT SUM(score) AS total_score FROM players;"],
            'dart' => ['syntax' => "int score = 10;\nString name = 'Ada';\nprint('\$name scored \$score');", 'data' => "List<int> scores = [10, 20, 30];\nint total = scores.reduce((a, b) => a + b);\nprint(total); // 60"],
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
                    'learning_outcomes' => $courseData['learning_outcomes'],
                    'prerequisites' => $courseData['prerequisites'],
                    'target_audience' => $courseData['target_audience'],
                ],
            );

            $skillIds = Skill::query()
                ->whereIn('slug', array_map(fn ($s) => Str::slug($s), $courseData['skills']))
                ->pluck('id');

            if ($skillIds->isNotEmpty()) {
                $course->skills()->sync($skillIds);
            }

            $snippets = $codeExamplesByLanguage[$courseData['language']] ?? null;

            foreach ($lessonOutline as $index => $lessonData) {
                $lessonTitle = $lessonData['title'];

                $codeExample = match ($index) {
                    1 => $snippets['syntax'] ?? null,
                    2 => $snippets['data'] ?? null,
                    default => null,
                };

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
                        'key_takeaways' => $lessonData['takeaways'],
                        'code_example' => $codeExample,
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
