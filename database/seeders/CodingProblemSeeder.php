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
            [
                'title' => 'Two Sum',
                'language' => 'javascript',
                'skill' => 'Problem Solving',
                'difficulty' => 'easy',
                'description' => 'Given an array of integers and a target, return the indices of the two numbers that add up to the target.',
                'input' => '[2, 7, 11, 15], target = 9',
                'output' => '[0, 1]',
                'constraints' => '2 <= nums.length <= 10^4',
                'approach' => "The brute-force way checks every pair with two nested loops, which costs O(n^2) time. A much faster approach uses a hash map: walk through the array once, and for each element, compute its 'complement' (target - current value). Before inserting the current value into the map, check whether the complement already exists in the map. If it does, you have found the pair immediately; if not, store the current value with its index and continue. Because a hash map lookup and insert are both O(1) on average, the whole scan is O(n).",
                'examples' => [
                    ['input' => 'nums = [2, 7, 11, 15], target = 9', 'output' => '[0, 1]', 'explanation' => 'nums[0] + nums[1] = 2 + 7 = 9, so the indices [0, 1] are returned.'],
                    ['input' => 'nums = [3, 2, 4], target = 6', 'output' => '[1, 2]', 'explanation' => 'nums[1] + nums[2] = 2 + 4 = 6.'],
                    ['input' => 'nums = [3, 3], target = 6', 'output' => '[0, 1]', 'explanation' => 'The same value can be used twice as long as it comes from two different indices.'],
                ],
                'hints' => [
                    'Can you do better than checking every pair?',
                    'What if you stored each number you have already seen, along with its index, in a hash map?',
                    'For each new number, check if target minus that number is already in the map.',
                ],
                'time_complexity' => 'O(n)',
                'space_complexity' => 'O(n)',
            ],
            [
                'title' => 'Reverse a Linked List',
                'language' => 'python',
                'skill' => 'Problem Solving',
                'difficulty' => 'medium',
                'description' => 'Reverse a singly linked list and return the new head.',
                'input' => '1 -> 2 -> 3 -> 4 -> 5',
                'output' => '5 -> 4 -> 3 -> 2 -> 1',
                'constraints' => '0 <= number of nodes <= 5000',
                'approach' => "Use the iterative three-pointer technique: keep track of 'previous', 'current', and 'next' nodes. Starting with previous set to null and current set to the head, repeatedly save current.next in a temporary variable, point current.next back to previous, then advance previous and current one step forward. When current becomes null, previous is the new head of the reversed list. A recursive solution is also possible, recursing to the end of the list and then re-pointing links on the way back up, but it uses O(n) call-stack space.",
                'examples' => [
                    ['input' => '1 -> 2 -> 3 -> 4 -> 5', 'output' => '5 -> 4 -> 3 -> 2 -> 1', 'explanation' => 'Every next pointer is flipped so the list is traversed in the opposite order.'],
                    ['input' => '1 -> 2', 'output' => '2 -> 1', 'explanation' => 'A two-node list simply swaps direction.'],
                    ['input' => '[] (empty list)', 'output' => '[] (empty list)', 'explanation' => 'An empty list reversed is still empty; the head remains null.'],
                ],
                'hints' => [
                    'Try solving it iteratively first with three pointers before attempting recursion.',
                    'Always save "next" before you overwrite "current.next", or you will lose the rest of the list.',
                    'Think about what happens to the head and tail after reversal.',
                ],
                'time_complexity' => 'O(n)',
                'space_complexity' => 'O(1) iterative, O(n) recursive',
            ],
            [
                'title' => 'Valid Parentheses',
                'language' => 'java',
                'skill' => 'Problem Solving',
                'difficulty' => 'easy',
                'description' => 'Given a string of brackets, determine if the brackets are balanced and correctly nested.',
                'input' => '"()[]{}"',
                'output' => 'true',
                'constraints' => '1 <= s.length <= 10^4',
                'approach' => "Use a stack. Scan the string left to right: whenever you see an opening bracket, push it onto the stack. Whenever you see a closing bracket, check whether the top of the stack is the matching opening bracket. If it is, pop it; if it is not (or the stack is empty), the string is invalid immediately. After processing every character, the string is valid only if the stack is empty, meaning every opening bracket found a matching closing bracket in the correct order.",
                'examples' => [
                    ['input' => 's = "()[]{}"', 'output' => 'true', 'explanation' => 'Each pair opens and closes in the correct nested order.'],
                    ['input' => 's = "(]"', 'output' => 'false', 'explanation' => 'The closing bracket does not match the type of the most recent opening bracket.'],
                    ['input' => 's = "([)]"', 'output' => 'false', 'explanation' => 'The brackets overlap incorrectly instead of nesting properly.'],
                ],
                'hints' => [
                    'A stack is a natural fit whenever "most recent unmatched item" matters.',
                    'Push opening brackets; when you hit a closing bracket, compare it to the top of the stack.',
                    'Do not forget to check that the stack is empty at the very end.',
                ],
                'time_complexity' => 'O(n)',
                'space_complexity' => 'O(n)',
            ],
            [
                'title' => 'Longest Substring Without Repeating Characters',
                'language' => 'python',
                'skill' => 'Problem Solving',
                'difficulty' => 'medium',
                'description' => 'Find the length of the longest substring without repeating characters.',
                'input' => '"abcabcbb"',
                'output' => '3',
                'constraints' => '0 <= s.length <= 5 * 10^4',
                'approach' => "Use the sliding window technique with two pointers marking the current window's start and end, plus a hash set (or hash map of character to last-seen index) to track which characters are currently in the window. Expand the window by moving the right pointer forward one character at a time. If the character is already in the window, shrink the window from the left until the duplicate is removed. Track the maximum window size seen. Using a map of last-seen indices lets you jump the left pointer directly past the duplicate instead of removing one character at a time, keeping the whole scan linear.",
                'examples' => [
                    ['input' => 's = "abcabcbb"', 'output' => '3', 'explanation' => 'The answer is "abc", with a length of 3.'],
                    ['input' => 's = "bbbbb"', 'output' => '1', 'explanation' => 'The answer is "b", with a length of 1.'],
                    ['input' => 's = "pwwkew"', 'output' => '3', 'explanation' => 'The answer is "wke", with a length of 3. Note that "pwke" is not a substring since "wke" is not contiguous with "p".'],
                ],
                'hints' => [
                    'Brute force checks every substring, which is O(n^2) or worse — can a window that only ever grows or shrinks help?',
                    'Keep a set of characters currently inside your window.',
                    'When you see a repeat, shrink the window from the left until the repeat is gone.',
                ],
                'time_complexity' => 'O(n)',
                'space_complexity' => 'O(min(n, charset size))',
            ],
            [
                'title' => 'Merge Intervals',
                'language' => 'go',
                'skill' => 'System Design',
                'difficulty' => 'medium',
                'description' => 'Given a collection of intervals, merge all overlapping intervals.',
                'input' => '[[1,3],[2,6],[8,10],[15,18]]',
                'output' => '[[1,6],[8,10],[15,18]]',
                'constraints' => '1 <= intervals.length <= 10^4',
                'approach' => 'First sort the intervals by their start value. Then walk through them in order, keeping a "current merged interval". For each next interval, if its start is less than or equal to the current interval\'s end, they overlap, so extend the current interval\'s end to the maximum of the two ends. If it does not overlap, push the current merged interval to the result and start a new current interval. Sorting makes this a single linear pass, so the total cost is dominated by the sort.',
                'examples' => [
                    ['input' => 'intervals = [[1,3],[2,6],[8,10],[15,18]]', 'output' => '[[1,6],[8,10],[15,18]]', 'explanation' => '[1,3] and [2,6] overlap and merge into [1,6]; the rest do not overlap with anything.'],
                    ['input' => 'intervals = [[1,4],[4,5]]', 'output' => '[[1,5]]', 'explanation' => 'Intervals that only touch at an endpoint (4 == 4) are still considered overlapping and merge.'],
                ],
                'hints' => [
                    'Sorting by start value first makes overlaps easy to detect in a single pass.',
                    'Two intervals overlap when the next interval\'s start is <= the current merged interval\'s end.',
                    'Remember to flush the last merged interval after the loop ends.',
                ],
                'time_complexity' => 'O(n log n)',
                'space_complexity' => 'O(n)',
            ],
            [
                'title' => 'Binary Tree Level Order Traversal',
                'language' => 'java',
                'skill' => 'Problem Solving',
                'difficulty' => 'medium',
                'description' => 'Return the level order traversal of a binary tree\'s node values.',
                'input' => '[3,9,20,null,null,15,7]',
                'output' => '[[3],[9,20],[15,7]]',
                'constraints' => '0 <= number of nodes <= 2000',
                'approach' => 'This is a classic breadth-first search (BFS). Use a queue seeded with the root node. Process the tree level by level: at the start of each iteration, record how many nodes are currently in the queue (that is exactly the size of this level). Dequeue that many nodes, collect their values into the current level\'s list, and enqueue each of their non-null children. Once you have dequeued that many nodes, the current level is complete and is appended to the result; repeat until the queue is empty.',
                'examples' => [
                    ['input' => 'root = [3,9,20,null,null,15,7]', 'output' => '[[3],[9,20],[15,7]]', 'explanation' => 'Level 0 has just the root (3); level 1 has 9 and 20; level 2 has 15 and 7.'],
                    ['input' => 'root = [1]', 'output' => '[[1]]', 'explanation' => 'A single-node tree has one level containing only the root.'],
                    ['input' => 'root = [] (empty tree)', 'output' => '[] (empty list)', 'explanation' => 'An empty tree has no levels to report.'],
                ],
                'hints' => [
                    'BFS with a queue naturally processes nodes level by level.',
                    'Snapshot the queue\'s size at the start of each loop iteration to know where one level ends and the next begins.',
                    'Watch out for null children — do not enqueue them.',
                ],
                'time_complexity' => 'O(n)',
                'space_complexity' => 'O(n)',
            ],
            [
                'title' => 'Implement a Rate Limiter',
                'language' => 'go',
                'skill' => 'System Design',
                'difficulty' => 'hard',
                'description' => 'Design and implement a token-bucket rate limiter for an API.',
                'input' => 'capacity = 5, refillRate = 1/sec',
                'output' => 'Allows/denies requests based on the algorithm',
                'constraints' => 'Must be safe for concurrent access',
                'approach' => 'The token-bucket algorithm keeps a bucket that holds up to "capacity" tokens and refills at "refillRate" tokens per second. Track the current token count and the last-refill timestamp. On each request: first compute elapsed time since the last refill, add elapsed * refillRate tokens (capped at capacity), then check if at least one token is available. If so, consume one token and allow the request; otherwise deny it (or queue/delay it, depending on requirements). Because multiple requests can arrive concurrently, guard the token count and timestamp with a mutex, or use a lock-free approach with atomic compare-and-swap, to avoid race conditions.',
                'examples' => [
                    ['input' => 'capacity = 5, refillRate = 1/sec, 5 requests arrive instantly', 'output' => 'All 5 allowed, bucket now empty', 'explanation' => 'The bucket starts full at capacity, so the first burst up to capacity is allowed immediately.'],
                    ['input' => 'Same bucket, a 6th request arrives 0 seconds later', 'output' => 'Denied', 'explanation' => 'No time has passed to refill any tokens, so the bucket is still empty.'],
                    ['input' => 'Same bucket, a request arrives 3 seconds after that', 'output' => 'Allowed', 'explanation' => 'At 1 token/sec, 3 tokens have refilled, so a token is available.'],
                ],
                'hints' => [
                    'Model the bucket with a current token count and a last-refill timestamp rather than a background timer.',
                    'Compute refill lazily on each request: tokens += elapsed_seconds * refillRate, capped at capacity.',
                    'Protect shared state with a mutex or atomic operations since multiple goroutines may call this concurrently.',
                ],
                'time_complexity' => 'O(1) per request',
                'space_complexity' => 'O(1) per bucket (O(k) for k tracked clients)',
            ],
            [
                'title' => 'Find the Missing Number',
                'language' => 'c++',
                'skill' => 'Problem Solving',
                'difficulty' => 'easy',
                'description' => 'Given an array containing n distinct numbers from 0 to n, find the missing number.',
                'input' => '[3, 0, 1]',
                'output' => '2',
                'constraints' => '1 <= n <= 10^4',
                'approach' => 'The array has n numbers drawn from the range [0, n], meaning exactly one value in that range is missing. Compute the expected sum of all numbers from 0 to n using the formula n * (n + 1) / 2, then subtract the actual sum of the array elements. The difference is the missing number. An alternative that avoids any risk of integer overflow uses XOR: XOR all indices 0..n together with all array values; every present number cancels with its index, leaving only the missing number.',
                'examples' => [
                    ['input' => 'nums = [3, 0, 1]', 'output' => '2', 'explanation' => 'n = 3, expected sum = 0+1+2+3 = 6, actual sum = 3+0+1 = 4, missing = 6 - 4 = 2.'],
                    ['input' => 'nums = [0, 1]', 'output' => '2', 'explanation' => 'n = 2, expected sum = 0+1+2 = 3, actual sum = 0+1 = 1, missing = 2.'],
                    ['input' => 'nums = [9,6,4,2,3,5,7,0,1]', 'output' => '8', 'explanation' => 'n = 9; every number from 0 to 9 except 8 is present.'],
                ],
                'hints' => [
                    'You know exactly which numbers should be present (0 through n) — use that.',
                    'The Gauss sum formula n*(n+1)/2 gives the expected total instantly.',
                    'XOR is a nice alternative if you are worried about integer overflow on very large arrays.',
                ],
                'time_complexity' => 'O(n)',
                'space_complexity' => 'O(1)',
            ],
            [
                'title' => 'LRU Cache',
                'language' => 'python',
                'skill' => 'System Design',
                'difficulty' => 'hard',
                'description' => 'Design a data structure that follows the constraints of a Least Recently Used (LRU) cache.',
                'input' => 'capacity = 2, put/get operations',
                'output' => 'Correct eviction order maintained',
                'constraints' => 'O(1) average time for get and put',
                'approach' => 'Combine a hash map with a doubly linked list. The hash map gives O(1) lookup from key to the corresponding list node; the doubly linked list keeps nodes ordered from most-recently-used (head) to least-recently-used (tail), and its pointer structure lets you remove or re-insert a node in O(1) without scanning. On "get", if the key exists, move its node to the head (marking it most recently used) and return its value. On "put", if the key exists, update its value and move it to the head; if it does not exist and the cache is at capacity, remove the tail node (the least recently used) before inserting the new node at the head.',
                'examples' => [
                    ['input' => 'capacity = 2; put(1,1); put(2,2); get(1); put(3,3); get(2)', 'output' => '1, then -1', 'explanation' => 'get(1) returns 1 and marks key 1 as recently used; put(3,3) then evicts key 2 (least recently used), so get(2) returns -1 (not found).'],
                    ['input' => 'capacity = 1; put(2,1); put(3,2); get(2)', 'output' => '-1', 'explanation' => 'With capacity 1, inserting key 3 immediately evicts key 2.'],
                ],
                'hints' => [
                    'A hash map alone gives fast lookup but no fast way to know what is "least recently used".',
                    'A doubly linked list alone gives ordering but slow lookup by key — combine both.',
                    'Every get or successful put should move that node to the "most recently used" end of the list.',
                ],
                'time_complexity' => 'O(1) for get and put',
                'space_complexity' => 'O(capacity)',
            ],
            [
                'title' => 'FizzBuzz',
                'language' => 'javascript',
                'skill' => 'Problem Solving',
                'difficulty' => 'easy',
                'description' => 'Print numbers 1 to n, replacing multiples of 3 with "Fizz", 5 with "Buzz", and both with "FizzBuzz".',
                'input' => 'n = 15',
                'output' => '1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz 11 Fizz 13 14 FizzBuzz',
                'constraints' => '1 <= n <= 10^4',
                'approach' => 'Loop from 1 to n. For each number, check divisibility by 3 and 5 together first (i.e., divisibility by 15) to catch the "FizzBuzz" case before checking each condition individually — otherwise you would print "Fizz" or "Buzz" and skip the combined case. If divisible by 3 only, print "Fizz"; if divisible by 5 only, print "Buzz"; otherwise print the number itself.',
                'examples' => [
                    ['input' => 'n = 5', 'output' => '1 2 Fizz 4 Buzz', 'explanation' => '3 is divisible by 3 so it becomes "Fizz"; 5 is divisible by 5 so it becomes "Buzz".'],
                    ['input' => 'n = 15', 'output' => '1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz 11 Fizz 13 14 FizzBuzz', 'explanation' => '15 is divisible by both 3 and 5, so it becomes "FizzBuzz".'],
                ],
                'hints' => [
                    'Check the "divisible by both" condition first, or combine conditions to avoid ordering bugs.',
                    'The modulo operator (%) is your friend for checking divisibility.',
                    'Build the output string incrementally: append "Fizz" if divisible by 3, then "Buzz" if divisible by 5, and print the number only if neither applies.',
                ],
                'time_complexity' => 'O(n)',
                'space_complexity' => 'O(1) (excluding output)',
            ],
            [
                'title' => 'Detect a Cycle in a Graph',
                'language' => 'c++',
                'skill' => 'Problem Solving',
                'difficulty' => 'hard',
                'description' => 'Given a directed graph, determine whether it contains a cycle.',
                'input' => 'edges = [[0,1],[1,2],[2,0]]',
                'output' => 'true',
                'constraints' => '1 <= number of nodes <= 10^4',
                'approach' => 'Use depth-first search with three-color marking (white/gray/black), or equivalently a "visiting" and "visited" set. Every node starts unvisited (white). When DFS enters a node, mark it gray (currently on the recursion stack). Recurse into its neighbors: if a neighbor is gray, you have found a back edge, meaning a cycle exists. If a neighbor is black (fully processed) or unvisited, continue normally. When DFS finishes exploring a node and all its descendants, mark it black. A cycle exists if and only if DFS ever encounters a gray node during the traversal. Alternatively, Kahn\'s algorithm (BFS-based topological sort) detects a cycle if not all nodes can be processed once their in-degree reaches zero.',
                'examples' => [
                    ['input' => 'edges = [[0,1],[1,2],[2,0]]', 'output' => 'true', 'explanation' => 'Following 0 -> 1 -> 2 -> 0 forms a cycle back to the starting node.'],
                    ['input' => 'edges = [[0,1],[1,2],[2,3]]', 'output' => 'false', 'explanation' => 'This is a simple chain with no path leading back to an earlier node.'],
                ],
                'hints' => [
                    'A cycle in a directed graph corresponds to a "back edge" during DFS — an edge to a node currently on the recursion stack.',
                    'Track three states per node: unvisited, currently-in-recursion-stack, and fully-processed.',
                    'Kahn\'s algorithm is a solid BFS-based alternative: if you cannot topologically sort all nodes, a cycle exists.',
                ],
                'time_complexity' => 'O(V + E)',
                'space_complexity' => 'O(V)',
            ],
            [
                'title' => 'Quick Sort Implementation',
                'language' => 'rust',
                'skill' => 'Problem Solving',
                'difficulty' => 'medium',
                'description' => 'Implement the quicksort algorithm to sort an array of integers in place.',
                'input' => '[5, 3, 8, 4, 2]',
                'output' => '[2, 3, 4, 5, 8]',
                'constraints' => '0 <= array.length <= 10^5',
                'approach' => 'Quicksort is a divide-and-conquer algorithm. Pick a pivot element (commonly the last, first, or a random element to avoid worst-case behavior on sorted input). Partition the array so that every element smaller than the pivot ends up to its left and every element larger ends up to its right, placing the pivot in its final sorted position. Then recursively apply the same process to the sub-array left of the pivot and the sub-array right of the pivot. The base case is a sub-array of length 0 or 1, which is already sorted.',
                'examples' => [
                    ['input' => 'arr = [5, 3, 8, 4, 2]', 'output' => '[2, 3, 4, 5, 8]', 'explanation' => 'Partitioning around a pivot repeatedly narrows the array until it is fully sorted.'],
                    ['input' => 'arr = [1]', 'output' => '[1]', 'explanation' => 'A single-element array is already sorted; this is the recursion\'s base case.'],
                ],
                'hints' => [
                    'A random pivot choice helps avoid the O(n^2) worst case on already-sorted or adversarial input.',
                    'The partition step should place the pivot in its correct final index and return that index.',
                    'Recurse on the two sides of the pivot, excluding the pivot itself since it is already placed correctly.',
                ],
                'time_complexity' => 'O(n log n) average, O(n^2) worst case',
                'space_complexity' => 'O(log n) average (recursion stack)',
            ],
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
                    'approach' => $problem['approach'],
                    'examples' => $problem['examples'],
                    'hints' => $problem['hints'],
                    'time_complexity' => $problem['time_complexity'],
                    'space_complexity' => $problem['space_complexity'],
                ],
            );
        }
    }
}
