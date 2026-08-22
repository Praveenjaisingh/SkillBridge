<?php

namespace Database\Seeders;

use App\Models\ProgrammingLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgrammingLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'JavaScript', 'icon' => '🟨', 'description' => 'The dynamic scripting language that powers interactive web pages and runs everywhere from browsers to servers via Node.js.'],
            ['name' => 'TypeScript', 'icon' => '🔷', 'description' => 'A strongly typed superset of JavaScript that adds static types, catching bugs before they reach production.'],
            ['name' => 'Python', 'icon' => '🐍', 'description' => 'A readable, general-purpose language beloved for web development, data science, automation, and machine learning.'],
            ['name' => 'Java', 'icon' => '☕', 'description' => 'A mature, object-oriented, write-once-run-anywhere language widely used in enterprise and Android development.'],
            ['name' => 'C', 'icon' => '🔧', 'description' => 'The foundational systems language that underpins operating systems, embedded devices, and countless other languages.'],
            ['name' => 'C++', 'icon' => '➕', 'description' => 'A high-performance, object-oriented extension of C used in game engines, browsers, and performance-critical systems.'],
            ['name' => 'C#', 'icon' => '🎯', 'description' => 'A modern, versatile language from Microsoft used for game development with Unity, desktop apps, and enterprise systems.'],
            ['name' => 'Go', 'icon' => '🐹', 'description' => 'A simple, fast, and statically typed language from Google designed for concurrency and cloud-native services.'],
            ['name' => 'Rust', 'icon' => '🦀', 'description' => 'A systems language focused on memory safety and performance without a garbage collector.'],
            ['name' => 'Ruby', 'icon' => '💎', 'description' => 'An elegant, developer-friendly language famous for the Ruby on Rails web framework.'],
            ['name' => 'PHP', 'icon' => '🐘', 'description' => 'A widely used server-side scripting language that powers a huge share of the web, including WordPress and Laravel.'],
            ['name' => 'Swift', 'icon' => '🦅', 'description' => 'Apple\'s modern, safe, and fast language for building iOS, macOS, watchOS, and tvOS applications.'],
            ['name' => 'Kotlin', 'icon' => '🟣', 'description' => 'A concise, modern language that is fully interoperable with Java and is the preferred language for Android development.'],
            ['name' => 'Dart', 'icon' => '🎯', 'description' => 'A client-optimized language from Google best known for powering the Flutter cross-platform UI toolkit.'],
            ['name' => 'SQL', 'icon' => '🗄️', 'description' => 'The standard language for querying, updating, and managing data in relational databases.'],
            ['name' => 'R', 'icon' => '📊', 'description' => 'A language purpose-built for statistical computing, data analysis, and visualization.'],
            ['name' => 'Scala', 'icon' => '🔴', 'description' => 'A hybrid functional and object-oriented language that runs on the JVM, popular for big data processing with Spark.'],
            ['name' => 'Perl', 'icon' => '🐪', 'description' => 'A veteran scripting language known for powerful text processing and system administration capabilities.'],
            ['name' => 'Haskell', 'icon' => '📐', 'description' => 'A purely functional programming language with strong static typing, favored for its mathematical rigor.'],
            ['name' => 'Elixir', 'icon' => '💧', 'description' => 'A functional language built on the Erlang VM, designed for building scalable and fault-tolerant applications.'],
            ['name' => 'Lua', 'icon' => '🌙', 'description' => 'A lightweight, embeddable scripting language commonly used in game development and configuration.'],
            ['name' => 'Objective-C', 'icon' => '🍎', 'description' => 'The original language for Apple platform development, still used to maintain legacy iOS and macOS codebases.'],
            ['name' => 'Shell / Bash', 'icon' => '💻', 'description' => 'The scripting language of the command line, essential for automation, DevOps, and system administration.'],
            ['name' => 'MATLAB', 'icon' => '🧮', 'description' => 'A numerical computing environment and language widely used in engineering, research, and academia.'],
            ['name' => 'Assembly', 'icon' => '⚙️', 'description' => 'A low-level language that maps closely to machine instructions, used for performance-critical and embedded code.'],
            ['name' => 'Julia', 'icon' => '🟢', 'description' => 'A high-performance language designed for numerical and scientific computing with dynamic-language ease of use.'],
            ['name' => 'Groovy', 'icon' => '🎼', 'description' => 'A dynamic language for the JVM that integrates smoothly with Java, popular for build scripts and Gradle.'],
            ['name' => 'Clojure', 'icon' => '🔵', 'description' => 'A modern, functional dialect of Lisp that runs on the JVM and emphasizes immutability.'],
            ['name' => 'F#', 'icon' => '🔷', 'description' => 'A functional-first language on the .NET platform, great for data processing and concise, correct code.'],
            ['name' => 'HTML/CSS', 'icon' => '🎨', 'description' => 'The markup and styling languages that structure and design every page on the web.'],
        ];

        foreach ($languages as $language) {
            ProgrammingLanguage::query()->updateOrCreate(
                ['slug' => Str::slug($language['name'])],
                [
                    'name' => $language['name'],
                    'icon' => $language['icon'],
                    'description' => $language['description'],
                ],
            );
        }
    }
}
