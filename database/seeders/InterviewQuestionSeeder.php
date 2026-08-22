<?php

namespace Database\Seeders;

use App\Models\InterviewQuestion;
use App\Models\ProgrammingLanguage;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InterviewQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            ['question' => 'What is the difference between "var", "let", and "const" in JavaScript?', 'answer' => '"var" is function-scoped and can be redeclared; "let" and "const" are block-scoped. "const" additionally cannot be reassigned after declaration.', 'language' => 'javascript', 'difficulty' => 'easy', 'category' => 'Fundamentals'],
            ['question' => 'Explain closures in JavaScript with an example.', 'answer' => 'A closure is a function that retains access to variables from its enclosing scope even after that scope has finished executing, which is useful for data privacy and factory functions.', 'language' => 'javascript', 'difficulty' => 'medium', 'category' => 'Fundamentals'],
            ['question' => 'What is the Global Interpreter Lock (GIL) in Python?', 'answer' => 'The GIL is a mutex that allows only one thread to execute Python bytecode at a time in CPython, which limits true parallelism for CPU-bound multithreaded programs.', 'language' => 'python', 'difficulty' => 'medium', 'category' => 'Concurrency'],
            ['question' => 'What are Python decorators and when would you use one?', 'answer' => 'Decorators are functions that wrap other functions to extend or modify their behavior without changing their source code, commonly used for logging, caching, and access control.', 'language' => 'python', 'difficulty' => 'medium', 'category' => 'Fundamentals'],
            ['question' => 'What is the difference between an abstract class and an interface in Java?', 'answer' => 'An abstract class can have both implemented and abstract methods and supports single inheritance, while an interface traditionally only declares method signatures and supports multiple inheritance.', 'language' => 'java', 'difficulty' => 'medium', 'category' => 'OOP'],
            ['question' => 'Explain the concept of garbage collection in Java.', 'answer' => 'Garbage collection automatically reclaims memory used by objects that are no longer reachable, freeing developers from manual memory management.', 'language' => 'java', 'difficulty' => 'easy', 'category' => 'Fundamentals'],
            ['question' => 'What is RAII in C++?', 'answer' => 'Resource Acquisition Is Initialization ties resource lifetime to object lifetime, ensuring resources like memory or file handles are released automatically when an object goes out of scope.', 'language' => 'c++', 'difficulty' => 'hard', 'category' => 'Memory Management'],
            ['question' => 'What is the difference between a stack and a heap?', 'answer' => 'The stack stores local variables with fast, automatic allocation and deallocation in LIFO order, while the heap stores dynamically allocated memory that must be managed explicitly or via garbage collection.', 'language' => null, 'difficulty' => 'easy', 'category' => 'Fundamentals'],
            ['question' => 'What are goroutines in Go and how do they differ from OS threads?', 'answer' => 'Goroutines are lightweight, Go-runtime-managed concurrent functions that are cheaper than OS threads because thousands can run with a small memory footprint, multiplexed onto fewer OS threads.', 'language' => 'go', 'difficulty' => 'medium', 'category' => 'Concurrency'],
            ['question' => 'What makes Rust\'s ownership model unique?', 'answer' => 'Rust enforces a single owner for each value at compile time, using borrowing and lifetimes to guarantee memory safety without a garbage collector.', 'language' => 'rust', 'difficulty' => 'hard', 'category' => 'Memory Management'],
            ['question' => 'What is dependency injection and why is it useful?', 'answer' => 'Dependency injection provides an object\'s dependencies from the outside rather than having it construct them itself, improving testability, decoupling, and flexibility.', 'language' => 'c#', 'difficulty' => 'medium', 'category' => 'System Design'],
            ['question' => 'Explain normalization in relational databases.', 'answer' => 'Normalization organizes data to reduce redundancy and improve integrity by dividing tables and defining relationships, typically following normal forms like 1NF, 2NF, and 3NF.', 'language' => 'sql', 'difficulty' => 'medium', 'category' => 'Database'],
            ['question' => 'What is the difference between SQL INNER JOIN and LEFT JOIN?', 'answer' => 'INNER JOIN returns only rows with matches in both tables, while LEFT JOIN returns all rows from the left table plus matched rows from the right table, filling unmatched columns with NULL.', 'language' => 'sql', 'difficulty' => 'easy', 'category' => 'Database'],
            ['question' => 'What is the difference between REST and GraphQL?', 'answer' => 'REST exposes fixed endpoints returning fixed data shapes, while GraphQL exposes a single endpoint where clients specify exactly the data they need, reducing over- and under-fetching.', 'language' => null, 'difficulty' => 'medium', 'category' => 'System Design'],
            ['question' => 'How would you design a URL shortening service?', 'answer' => 'Key considerations include a hashing or counter-based scheme for short codes, a fast key-value store for lookups, handling collisions, analytics tracking, and horizontal scalability.', 'language' => null, 'difficulty' => 'hard', 'category' => 'System Design'],
            ['question' => 'What is Big O notation and why does it matter?', 'answer' => 'Big O notation describes the upper bound of an algorithm\'s time or space complexity as input size grows, helping engineers compare algorithm efficiency and predict scalability.', 'language' => null, 'difficulty' => 'easy', 'category' => 'Fundamentals'],
        ];

        foreach ($questions as $question) {
            $language = $question['language']
                ? ProgrammingLanguage::query()->where('slug', Str::slug($question['language']))->first()
                : null;

            $skill = Skill::query()->where('category', $question['category'])->inRandomOrder()->first()
                ?? Skill::query()->where('slug', Str::slug('Problem Solving'))->first();

            InterviewQuestion::query()->firstOrCreate(
                ['question' => $question['question']],
                [
                    'skill_id' => $skill?->id,
                    'programming_language_id' => $language?->id,
                    'answer' => $question['answer'],
                    'difficulty' => $question['difficulty'],
                    'category' => $question['category'],
                ],
            );
        }
    }
}
