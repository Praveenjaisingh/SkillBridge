<?php

namespace Database\Seeders;

use App\Models\CodingProblem;
use App\Models\ProgrammingLanguage;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CodingProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $problems = [
            ['title' => 'Two Sum', 'language' => 'javascript', 'skill' => 'Problem Solving', 'difficulty' => 'easy', 'description' => 'Given an array of integers and a target, return the indices of the two numbers that add up to the target.', 'input' => '[2, 7, 11, 15], target = 9', 'output' => '[0, 1]', 'constraints' => '2 <= nums.length <= 10^4'],
            ['title' => 'Reverse a Linked List', 'language' => 'python', 'skill' => 'Problem Solving', 'difficulty' => 'medium', 'description' => 'Reverse a singly linked list and return the new head.', 'input' => '1 -> 2 -> 3 -> 4 -> 5', 'output' => '5 -> 4 -> 3 -> 2 -> 1', 'constraints' => '0 <= number of nodes <= 5000'],
            ['title' => 'Valid Parentheses', 'language' => 'java', 'skill' => 'Problem Solving', 'difficulty' => 'easy', 'description' => 'Given a string of brackets, determine if the brackets are balanced and correctly nested.', 'input' => '"()[]{}"', 'output' => 'true', 'constraints' => '1 <= s.length <= 10^4'],
            ['title' => 'Longest Substring Without Repeating Characters', 'language' => 'python', 'skill' => 'Problem Solving', 'difficulty' => 'medium', 'description' => 'Find the length of the longest substring without repeating characters.', 'input' => '"abcabcbb"', 'output' => '3', 'constraints' => '0 <= s.length <= 5 * 10^4'],
            ['title' => 'Merge Intervals', 'language' => 'go', 'skill' => 'System Design', 'difficulty' => 'medium', 'description' => 'Given a collection of intervals, merge all overlapping intervals.', 'input' => '[[1,3],[2,6],[8,10],[15,18]]', 'output' => '[[1,6],[8,10],[15,18]]', 'constraints' => '1 <= intervals.length <= 10^4'],
            ['title' => 'Binary Tree Level Order Traversal', 'language' => 'java', 'skill' => 'Problem Solving', 'difficulty' => 'medium', 'description' => 'Return the level order traversal of a binary tree\'s node values.', 'input' => '[3,9,20,null,null,15,7]', 'output' => '[[3],[9,20],[15,7]]', 'constraints' => '0 <= number of nodes <= 2000'],
            ['title' => 'Implement a Rate Limiter', 'language' => 'go', 'skill' => 'System Design', 'difficulty' => 'hard', 'description' => 'Design and implement a token-bucket rate limiter for an API.', 'input' => 'capacity = 5, refillRate = 1/sec', 'output' => 'Allows/denies requests based on the algorithm', 'constraints' => 'Must be safe for concurrent access'],
            ['title' => 'Find the Missing Number', 'language' => 'c++', 'skill' => 'Problem Solving', 'difficulty' => 'easy', 'description' => 'Given an array containing n distinct numbers from 0 to n, find the missing number.', 'input' => '[3, 0, 1]', 'output' => '2', 'constraints' => '1 <= n <= 10^4'],
            ['title' => 'LRU Cache', 'language' => 'python', 'skill' => 'System Design', 'difficulty' => 'hard', 'description' => 'Design a data structure that follows the constraints of a Least Recently Used (LRU) cache.', 'input' => 'capacity = 2, put/get operations', 'output' => 'Correct eviction order maintained', 'constraints' => 'O(1) average time for get and put'],
            ['title' => 'FizzBuzz', 'language' => 'javascript', 'skill' => 'Problem Solving', 'difficulty' => 'easy', 'description' => 'Print numbers 1 to n, replacing multiples of 3 with "Fizz", 5 with "Buzz", and both with "FizzBuzz".', 'input' => 'n = 15', 'output' => '1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz 11 Fizz 13 14 FizzBuzz', 'constraints' => '1 <= n <= 10^4'],
            ['title' => 'Detect a Cycle in a Graph', 'language' => 'c++', 'skill' => 'Problem Solving', 'difficulty' => 'hard', 'description' => 'Given a directed graph, determine whether it contains a cycle.', 'input' => 'edges = [[0,1],[1,2],[2,0]]', 'output' => 'true', 'constraints' => '1 <= number of nodes <= 10^4'],
            ['title' => 'Quick Sort Implementation', 'language' => 'rust', 'skill' => 'Problem Solving', 'difficulty' => 'medium', 'description' => 'Implement the quicksort algorithm to sort an array of integers in place.', 'input' => '[5, 3, 8, 4, 2]', 'output' => '[2, 3, 4, 5, 8]', 'constraints' => '0 <= array.length <= 10^5'],
        ];

        foreach ($problems as $problem) {
            $language = ProgrammingLanguage::query()->where('slug', Str::slug($problem['language']))->first();
            $skill = Skill::query()->where('slug', Str::slug($problem['skill']))->first();

            CodingProblem::query()->updateOrCreate(
                ['slug' => Str::slug($problem['title'])],
                [
                    'skill_id' => $skill?->id,
                    'programming_language_id' => $language?->id,
                    'title' => $problem['title'],
                    'description' => $problem['description'],
                    'difficulty' => $problem['difficulty'],
                    'sample_input' => $problem['input'],
                    'sample_output' => $problem['output'],
                    'constraints' => $problem['constraints'],
                ],
            );
        }
    }
}
