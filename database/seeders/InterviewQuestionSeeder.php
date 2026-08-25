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
            [
                'question' => 'What is the difference between "var", "let", and "const" in JavaScript?',
                'answer' => '"var" is function-scoped and can be redeclared; "let" and "const" are block-scoped. "const" additionally cannot be reassigned after declaration.',
                'language' => 'javascript',
                'difficulty' => 'easy',
                'category' => 'Fundamentals',
                'detailed_explanation' => '"var" declarations are hoisted to the top of their enclosing function and initialized as undefined, which can lead to confusing bugs if used before declaration. "let" and "const" are also hoisted but land in a "temporal dead zone" — accessing them before their declaration throws a ReferenceError instead of silently returning undefined. "const" prevents reassignment of the binding itself, but if the value is an object or array, its contents can still be mutated; only the variable cannot be pointed at a new value.',
                'code_example' => "function example() {\n  if (true) {\n    var x = 1;\n    let y = 2;\n  }\n  console.log(x); // 1 - var leaks out of the block\n  console.log(y); // ReferenceError - let is block-scoped\n}\n\nconst arr = [1, 2, 3];\narr.push(4);   // OK, mutating contents is allowed\narr = [5, 6];  // TypeError, cannot reassign a const binding",
                'follow_up_questions' => [
                    'What is the temporal dead zone and why does it exist?',
                    'Can you reassign the contents of a const array or object? Why or why not?',
                    'What problems does variable hoisting with "var" cause in loops with closures?',
                ],
                'related_topics' => ['Scope', 'Hoisting', 'Closures'],
            ],
            [
                'question' => 'Explain closures in JavaScript with an example.',
                'answer' => 'A closure is a function that retains access to variables from its enclosing scope even after that scope has finished executing, which is useful for data privacy and factory functions.',
                'language' => 'javascript',
                'difficulty' => 'medium',
                'category' => 'Fundamentals',
                'detailed_explanation' => 'A closure forms whenever a function is defined inside another function and references variables from that outer function\'s scope. Even after the outer function returns, the inner function keeps a live reference to those variables rather than a copy, because JavaScript keeps the enclosing scope alive as long as something still references it. This is commonly used to create private state (variables that cannot be accessed directly from outside), memoization caches, and function factories that produce customized functions.',
                'code_example' => "function makeCounter() {\n  let count = 0; // private state, not accessible from outside\n  return function () {\n    count += 1;\n    return count;\n  };\n}\n\nconst counter = makeCounter();\ncounter(); // 1\ncounter(); // 2 - the closure remembers `count` between calls",
                'follow_up_questions' => [
                    'How would you use a closure to implement a memoization cache?',
                    'What is a common pitfall when creating closures inside a loop, and how do you fix it?',
                    'How do closures relate to how JavaScript modules encapsulate private state?',
                ],
                'related_topics' => ['Scope', 'Higher-Order Functions', 'Memory Management'],
            ],
            [
                'question' => 'What is the Global Interpreter Lock (GIL) in Python?',
                'answer' => 'The GIL is a mutex that allows only one thread to execute Python bytecode at a time in CPython, which limits true parallelism for CPU-bound multithreaded programs.',
                'language' => 'python',
                'difficulty' => 'medium',
                'category' => 'Concurrency',
                'detailed_explanation' => 'CPython manages memory using reference counting, which is not thread-safe on its own. The GIL exists to protect that reference counting from race conditions by only letting one thread run Python bytecode at any given instant, even on a multi-core machine. This means CPU-bound multithreaded Python code does not get a real speedup from adding threads. I/O-bound code is largely unaffected because the GIL is released during blocking I/O operations. To achieve genuine parallel CPU work, developers typically use the multiprocessing module (separate processes, separate GILs) or offload heavy computation to C extensions/libraries that release the GIL.',
                'code_example' => "import threading\n\ndef cpu_bound_work():\n    total = 0\n    for i in range(10_000_000):\n        total += i\n    return total\n\n# Adding more threads here will NOT speed up this CPU-bound work\n# because of the GIL - use multiprocessing instead for true parallelism.\nthreads = [threading.Thread(target=cpu_bound_work) for _ in range(4)]\nfor t in threads:\n    t.start()",
                'follow_up_questions' => [
                    'Why doesn\'t the GIL hurt I/O-bound multithreaded programs as much?',
                    'How does the multiprocessing module work around the GIL?',
                    'Are there Python implementations that do not have a GIL?',
                ],
                'related_topics' => ['Threading', 'Multiprocessing', 'CPython Internals'],
            ],
            [
                'question' => 'What are Python decorators and when would you use one?',
                'answer' => 'Decorators are functions that wrap other functions to extend or modify their behavior without changing their source code, commonly used for logging, caching, and access control.',
                'language' => 'python',
                'difficulty' => 'medium',
                'category' => 'Fundamentals',
                'detailed_explanation' => 'A decorator is a higher-order function that takes a function as input and returns a new function that usually calls the original one, adding behavior before or after it. The "@decorator_name" syntax above a function definition is syntactic sugar for "function = decorator_name(function)". Decorators are widely used for cross-cutting concerns like logging, timing, authentication checks, and caching, because they let you add that behavior once and apply it declaratively to any function without duplicating code.',
                'code_example' => "import functools\nimport time\n\ndef timer(func):\n    @functools.wraps(func)\n    def wrapper(*args, **kwargs):\n        start = time.perf_counter()\n        result = func(*args, **kwargs)\n        print(f'{func.__name__} took {time.perf_counter() - start:.4f}s')\n        return result\n    return wrapper\n\n@timer\ndef slow_add(a, b):\n    time.sleep(0.1)\n    return a + b\n\nslow_add(2, 3)  # prints timing, then returns 5",
                'follow_up_questions' => [
                    'Why is functools.wraps important when writing a decorator?',
                    'How would you write a decorator that accepts its own arguments, like @retry(times=3)?',
                    'What is the difference between a decorator and a context manager?',
                ],
                'related_topics' => ['Higher-Order Functions', 'Closures', 'Metaprogramming'],
            ],
            [
                'question' => 'What is the difference between an abstract class and an interface in Java?',
                'answer' => 'An abstract class can have both implemented and abstract methods and supports single inheritance, while an interface traditionally only declares method signatures and supports multiple inheritance.',
                'language' => 'java',
                'difficulty' => 'medium',
                'category' => 'OOP',
                'detailed_explanation' => 'An abstract class is meant to represent a partial implementation that related subclasses share; it can hold instance state (fields), constructors, and a mix of concrete and abstract methods, but a class can only extend one abstract (or any) class. An interface defines a contract of behavior that unrelated classes can agree to implement; since Java 8, interfaces can include default and static methods with bodies, but they still cannot hold instance state, and a class can implement any number of interfaces. Use an abstract class when subclasses share common state or implementation; use an interface when you need to describe a capability that can apply across otherwise-unrelated classes.',
                'code_example' => "abstract class Animal {\n    protected String name;\n    Animal(String name) { this.name = name; }\n    abstract String makeSound();\n    void printName() { System.out.println(name); } // shared implementation\n}\n\ninterface Flyable {\n    void fly(); // implicitly public abstract\n    default void land() { System.out.println(\"Landing...\"); }\n}\n\nclass Sparrow extends Animal implements Flyable {\n    Sparrow() { super(\"Sparrow\"); }\n    String makeSound() { return \"Chirp\"; }\n    public void fly() { System.out.println(\"Flying\"); }\n}",
                'follow_up_questions' => [
                    'Can an abstract class implement an interface without implementing all its methods?',
                    'What was the motivation for adding default methods to interfaces in Java 8?',
                    'When would you choose composition over either abstract classes or interfaces?',
                ],
                'related_topics' => ['Inheritance', 'Polymorphism', 'Design Patterns'],
            ],
            [
                'question' => 'Explain the concept of garbage collection in Java.',
                'answer' => 'Garbage collection automatically reclaims memory used by objects that are no longer reachable, freeing developers from manual memory management.',
                'language' => 'java',
                'difficulty' => 'easy',
                'category' => 'Fundamentals',
                'detailed_explanation' => 'The JVM tracks objects allocated on the heap and periodically runs a garbage collector to identify objects that are no longer reachable from any active thread, static reference, or local variable — these are considered garbage and their memory is reclaimed. Modern collectors (like G1 or ZGC) use a generational approach: most objects die young, so the heap is split into a young generation (collected frequently and cheaply) and an old generation (collected less often). This automatic reclamation avoids classic manual-memory bugs like dangling pointers and double frees, at the cost of some unpredictable pause times and CPU overhead.',
                'code_example' => "public void createObjects() {\n    for (int i = 0; i < 1000; i++) {\n        Object temp = new Object(); // eligible for GC as soon as\n    }                                // the loop iteration ends and\n                                       // nothing else references it\n}\n// Developers cannot force GC to run (System.gc() is only a hint),\n// but they can help by removing references (e.g., setting to null)\n// when an object is no longer needed.",
                'follow_up_questions' => [
                    'What is the difference between the young and old generation in the JVM heap?',
                    'What can cause a memory leak in Java despite having garbage collection?',
                    'What is the difference between a strong, weak, and soft reference?',
                ],
                'related_topics' => ['Memory Management', 'JVM Internals', 'Performance Tuning'],
            ],
            [
                'question' => 'What is RAII in C++?',
                'answer' => 'Resource Acquisition Is Initialization ties resource lifetime to object lifetime, ensuring resources like memory or file handles are released automatically when an object goes out of scope.',
                'language' => 'c++',
                'difficulty' => 'hard',
                'category' => 'Memory Management',
                'detailed_explanation' => 'RAII is a C++ idiom where a resource (memory, a file handle, a network socket, a mutex lock) is acquired in a class constructor and released in its destructor. Because C++ guarantees that destructors run when an object goes out of scope — including during stack unwinding from an exception — RAII gives deterministic, exception-safe resource cleanup without needing try/finally blocks. Standard library types like std::unique_ptr, std::vector, and std::lock_guard are all built on this idiom: you never have to remember to manually free them.',
                'code_example' => "class FileHandle {\npublic:\n    explicit FileHandle(const std::string& path) {\n        file_ = std::fopen(path.c_str(), \"r\");\n    }\n    ~FileHandle() {\n        if (file_) std::fclose(file_); // always runs, even on exceptions\n    }\nprivate:\n    FILE* file_;\n};\n\nvoid process() {\n    FileHandle f(\"data.txt\"); // resource acquired here\n    // ... use f ...\n} // destructor runs automatically here, file is closed",
                'follow_up_questions' => [
                    'How does std::unique_ptr use RAII to manage heap memory?',
                    'What happens to RAII objects during stack unwinding when an exception is thrown?',
                    'What is the difference between RAII and using a garbage collector?',
                ],
                'related_topics' => ['Smart Pointers', 'Exception Safety', 'Move Semantics'],
            ],
            [
                'question' => 'What is the difference between a stack and a heap?',
                'answer' => 'The stack stores local variables with fast, automatic allocation and deallocation in LIFO order, while the heap stores dynamically allocated memory that must be managed explicitly or via garbage collection.',
                'language' => null,
                'difficulty' => 'easy',
                'category' => 'Fundamentals',
                'detailed_explanation' => 'The stack is a fixed-size, LIFO region of memory used for function call frames: local variables, function parameters, and return addresses. Allocation and deallocation are extremely fast because they just move a stack pointer, and memory is automatically reclaimed when a function returns. The heap is a larger, more flexible pool used for objects whose size or lifetime is not known at compile time; allocation is slower and must be explicitly freed (in languages without garbage collection) or reclaimed by a garbage collector. Because the stack is bounded, deep or unbounded recursion can cause a stack overflow, while heap exhaustion typically manifests as an out-of-memory error instead.',
                'code_example' => "void example() {\n    int x = 5;              // stack: fast, automatically freed on return\n    int* y = new int(10);   // heap: must be freed manually (or via smart pointer)\n    delete y;                // forgetting this line causes a memory leak\n}",
                'follow_up_questions' => [
                    'What causes a stack overflow, and how does it differ from a heap overflow?',
                    'Why is stack allocation generally faster than heap allocation?',
                    'How do languages with garbage collection change this trade-off?',
                ],
                'related_topics' => ['Memory Management', 'Call Stack', 'Pointers'],
            ],
            [
                'question' => 'What are goroutines in Go and how do they differ from OS threads?',
                'answer' => 'Goroutines are lightweight, Go-runtime-managed concurrent functions that are cheaper than OS threads because thousands can run with a small memory footprint, multiplexed onto fewer OS threads.',
                'language' => 'go',
                'difficulty' => 'medium',
                'category' => 'Concurrency',
                'detailed_explanation' => 'A goroutine starts with a small stack (a few KB) that grows and shrinks dynamically, compared to an OS thread\'s typically fixed, much larger stack (often megabytes). The Go runtime schedules many goroutines onto a smaller pool of OS threads using an M:N scheduler, switching between them cooperatively at function calls, channel operations, and other safe points, which is far cheaper than an OS context switch. This lets a Go program comfortably run hundreds of thousands of goroutines, whereas the same number of OS threads would exhaust system memory. Goroutines communicate safely using channels, following Go\'s philosophy of "share memory by communicating" rather than communicating by sharing memory with locks.',
                'code_example' => "func worker(id int, jobs <-chan int, results chan<- int) {\n    for j := range jobs {\n        results <- j * 2\n    }\n}\n\nfunc main() {\n    jobs := make(chan int, 100)\n    results := make(chan int, 100)\n    for w := 1; w <= 3; w++ {\n        go worker(w, jobs, results) // cheap to spawn many goroutines\n    }\n    for j := 1; j <= 5; j++ {\n        jobs <- j\n    }\n    close(jobs)\n}",
                'follow_up_questions' => [
                    'How does Go\'s scheduler decide when to switch between goroutines?',
                    'What is the difference between an unbuffered and a buffered channel?',
                    'How would you detect and prevent a goroutine leak?',
                ],
                'related_topics' => ['Channels', 'Concurrency Patterns', 'Scheduling'],
            ],
            [
                'question' => 'What makes Rust\'s ownership model unique?',
                'answer' => 'Rust enforces a single owner for each value at compile time, using borrowing and lifetimes to guarantee memory safety without a garbage collector.',
                'language' => 'rust',
                'difficulty' => 'hard',
                'category' => 'Memory Management',
                'detailed_explanation' => 'In Rust, every value has exactly one owner variable, and when that owner goes out of scope, the value is dropped (its memory freed) automatically — similar in spirit to RAII in C++. Values can be "borrowed" temporarily, either immutably (multiple immutable borrows allowed at once) or mutably (only one mutable borrow allowed, and it excludes any other borrows), and the compiler\'s borrow checker enforces these rules at compile time, not at runtime. This eliminates entire classes of bugs — use-after-free, double frees, and data races — without needing a garbage collector, at the cost of a steeper learning curve while adapting to "fighting the borrow checker".',
                'code_example' => "fn main() {\n    let s1 = String::from(\"hello\");\n    let s2 = s1; // ownership moves to s2; s1 is no longer valid\n    // println!(\"{}\", s1); // compile error: value borrowed after move\n\n    let s3 = String::from(\"world\");\n    let len = calculate_length(&s3); // borrow s3 immutably\n    println!(\"{} has length {}\", s3, len); // s3 still valid here\n}\n\nfn calculate_length(s: &String) -> usize {\n    s.len()\n}",
                'follow_up_questions' => [
                    'What is the difference between "moving" and "borrowing" a value in Rust?',
                    'Why can you have many immutable borrows but only one mutable borrow at a time?',
                    'How do lifetimes let the compiler catch dangling references?',
                ],
                'related_topics' => ['Borrow Checker', 'Memory Safety', 'Lifetimes'],
            ],
            [
                'question' => 'What is dependency injection and why is it useful?',
                'answer' => 'Dependency injection provides an object\'s dependencies from the outside rather than having it construct them itself, improving testability, decoupling, and flexibility.',
                'language' => 'c#',
                'difficulty' => 'medium',
                'category' => 'System Design',
                'detailed_explanation' => 'Without dependency injection, a class typically creates the objects it depends on internally (e.g., "new EmailService()"), which tightly couples it to a specific implementation and makes unit testing hard, since you cannot easily swap in a fake. With dependency injection, dependencies are passed in — usually via the constructor — so the class only depends on an interface/abstraction, and a DI container wires up the concrete implementations at runtime. This makes it straightforward to substitute mocks or stubs in tests, swap implementations (e.g., a different payment gateway) without touching the consuming class, and centralize object lifetime management (singleton, scoped, transient).',
                'code_example' => "public interface IEmailService {\n    void Send(string to, string body);\n}\n\npublic class OrderService {\n    private readonly IEmailService _emailService;\n\n    // dependency is injected via the constructor, not created internally\n    public OrderService(IEmailService emailService) {\n        _emailService = emailService;\n    }\n\n    public void PlaceOrder(string customerEmail) {\n        // ... business logic ...\n        _emailService.Send(customerEmail, \"Your order has been placed!\");\n    }\n}\n\n// In tests: new OrderService(new FakeEmailService())\n// In production: container resolves the real SmtpEmailService",
                'follow_up_questions' => [
                    'What is the difference between constructor injection, property injection, and method injection?',
                    'What is the difference between transient, scoped, and singleton lifetimes in a DI container?',
                    'How does dependency injection relate to the Dependency Inversion Principle?',
                ],
                'related_topics' => ['SOLID Principles', 'Unit Testing', 'Inversion of Control'],
            ],
            [
                'question' => 'Explain normalization in relational databases.',
                'answer' => 'Normalization organizes data to reduce redundancy and improve integrity by dividing tables and defining relationships, typically following normal forms like 1NF, 2NF, and 3NF.',
                'language' => 'sql',
                'difficulty' => 'medium',
                'category' => 'Database',
                'detailed_explanation' => 'Normalization is a step-by-step process of restructuring tables to eliminate redundant data and avoid update, insertion, and deletion anomalies. First Normal Form (1NF) requires atomic column values with no repeating groups. Second Normal Form (2NF) requires 1NF plus every non-key column depending on the whole primary key, not just part of a composite key. Third Normal Form (3NF) requires 2NF plus no non-key column depending on another non-key column (removing transitive dependencies). Higher forms exist (BCNF, 4NF) for edge cases. In practice, most production schemas normalize to 3NF and then selectively denormalize specific tables for read performance where needed.',
                'code_example' => "-- Un-normalized: order_id repeats customer info and mixes concerns\n-- orders(order_id, customer_name, customer_email, product_name, product_price)\n\n-- Normalized into 3NF:\nCREATE TABLE customers (customer_id INT PRIMARY KEY, name VARCHAR(100), email VARCHAR(100));\nCREATE TABLE products (product_id INT PRIMARY KEY, name VARCHAR(100), price DECIMAL(8,2));\nCREATE TABLE orders (\n    order_id INT PRIMARY KEY,\n    customer_id INT REFERENCES customers(customer_id),\n    product_id INT REFERENCES products(product_id)\n);",
                'follow_up_questions' => [
                    'Can you give an example of an update anomaly caused by an un-normalized table?',
                    'When might you deliberately denormalize a schema, and what trade-off does that involve?',
                    'What is the difference between 3NF and Boyce-Codd Normal Form (BCNF)?',
                ],
                'related_topics' => ['Database Design', 'Schema Design', 'Data Integrity'],
            ],
            [
                'question' => 'What is the difference between SQL INNER JOIN and LEFT JOIN?',
                'answer' => 'INNER JOIN returns only rows with matches in both tables, while LEFT JOIN returns all rows from the left table plus matched rows from the right table, filling unmatched columns with NULL.',
                'language' => 'sql',
                'difficulty' => 'easy',
                'category' => 'Database',
                'detailed_explanation' => 'INNER JOIN produces the intersection of two tables based on a join condition: a row appears in the result only if it has a matching row on both sides. LEFT JOIN (LEFT OUTER JOIN) keeps every row from the left table regardless of whether a match exists on the right; when there is no match, the right table\'s columns are filled with NULL. This makes LEFT JOIN useful when you want to know about rows that might not have a related record — for example, listing all customers including those who have never placed an order.',
                'code_example' => "-- INNER JOIN: only customers who have at least one order\nSELECT c.name, o.id AS order_id\nFROM customers c\nINNER JOIN orders o ON o.customer_id = c.id;\n\n-- LEFT JOIN: all customers, with NULL order_id if they have none\nSELECT c.name, o.id AS order_id\nFROM customers c\nLEFT JOIN orders o ON o.customer_id = c.id;",
                'follow_up_questions' => [
                    'How would you find customers who have never placed an order using a LEFT JOIN?',
                    'What is the difference between a LEFT JOIN and a RIGHT JOIN?',
                    'How does a FULL OUTER JOIN differ from both of these?',
                ],
                'related_topics' => ['SQL Queries', 'Database Design', 'Query Optimization'],
            ],
            [
                'question' => 'What is the difference between REST and GraphQL?',
                'answer' => 'REST exposes fixed endpoints returning fixed data shapes, while GraphQL exposes a single endpoint where clients specify exactly the data they need, reducing over- and under-fetching.',
                'language' => null,
                'difficulty' => 'medium',
                'category' => 'System Design',
                'detailed_explanation' => 'A REST API typically defines many endpoints, each returning a predetermined shape of data for a resource; if a client needs data from multiple resources, it often has to make multiple round trips, or the server has to add ad-hoc query parameters to shape the response (over-fetching or under-fetching). GraphQL exposes a single endpoint backed by a strongly typed schema, and clients send a query describing exactly the fields they want, potentially spanning multiple related resources in one request. This gives clients flexibility and reduces network round trips, but shifts complexity to the server (query cost analysis, N+1 query problems, caching strategy) since a naive REST response is trivially cacheable by URL while a GraphQL query is not.',
                'code_example' => "# REST: multiple endpoints, fixed shape\nGET /users/42          -> { id, name, email }\nGET /users/42/posts     -> [{ id, title }, ...]\n\n# GraphQL: single endpoint, client-specified shape\nquery {\n  user(id: 42) {\n    name\n    posts {\n      title\n    }\n  }\n}",
                'follow_up_questions' => [
                    'What is the N+1 query problem in GraphQL and how do tools like DataLoader address it?',
                    'How does caching differ between REST and GraphQL responses?',
                    'In what situations would you still choose REST over GraphQL?',
                ],
                'related_topics' => ['API Design', 'Caching', 'Microservices'],
            ],
            [
                'question' => 'How would you design a URL shortening service?',
                'answer' => 'Key considerations include a hashing or counter-based scheme for short codes, a fast key-value store for lookups, handling collisions, analytics tracking, and horizontal scalability.',
                'language' => null,
                'difficulty' => 'hard',
                'category' => 'System Design',
                'detailed_explanation' => 'Start by clarifying requirements and scale: expected reads vs. writes (typically read-heavy), whether custom aliases are needed, and whether links should expire. For generating short codes, a common approach is a base62-encoded auto-incrementing counter (often sharded across ranges to avoid a single point of contention), or a hash of the URL with collision handling. Store the mapping in a key-value store (e.g., a distributed cache backed by a database) for O(1) lookups, since redirects are latency-sensitive. Use a CDN or edge cache in front of the redirect service for hot links, replicate/shard the datastore for scale, and add asynchronous analytics (click counts, geography) via an event stream so it does not slow down the redirect path itself.',
                'code_example' => "-- Simplified schema for the core mapping\nCREATE TABLE short_urls (\n    short_code VARCHAR(8) PRIMARY KEY, -- base62 encoded id\n    long_url   TEXT NOT NULL,\n    created_at TIMESTAMP DEFAULT now(),\n    expires_at TIMESTAMP NULL\n);\n\n-- Redirect flow (pseudocode):\n-- 1. Look up short_code in a cache (e.g., Redis) first\n-- 2. On cache miss, fall back to the database and populate the cache\n-- 3. Return HTTP 301/302 redirect to long_url\n-- 4. Emit a click event asynchronously for analytics",
                'follow_up_questions' => [
                    'How would you handle a hash collision when generating short codes?',
                    'How would you scale the datastore once you have billions of URLs?',
                    'Would you use a 301 or 302 redirect, and what is the trade-off?',
                ],
                'related_topics' => ['Scalability', 'Caching', 'Database Sharding'],
            ],
            [
                'question' => 'What is Big O notation and why does it matter?',
                'answer' => 'Big O notation describes the upper bound of an algorithm\'s time or space complexity as input size grows, helping engineers compare algorithm efficiency and predict scalability.',
                'language' => null,
                'difficulty' => 'easy',
                'category' => 'Fundamentals',
                'detailed_explanation' => 'Big O notation expresses how the running time or memory usage of an algorithm grows relative to the size of its input, in the worst case, while ignoring constant factors and lower-order terms. It lets engineers reason about scalability independent of hardware: an O(n) algorithm will eventually outperform an O(n^2) algorithm as input size grows, even if the O(n^2) algorithm is faster on small inputs due to a smaller constant factor. It is a tool for comparing approaches and predicting how code will behave as data grows, not a precise measurement of real-world speed, which also depends on constants, memory access patterns, and hardware.',
                'code_example' => "// O(n) - single pass\nfunction sumArray(arr) {\n  let total = 0;\n  for (const n of arr) total += n;\n  return total;\n}\n\n// O(n^2) - nested loop over the same input\nfunction hasDuplicate(arr) {\n  for (let i = 0; i < arr.length; i++) {\n    for (let j = i + 1; j < arr.length; j++) {\n      if (arr[i] === arr[j]) return true;\n    }\n  }\n  return false;\n}",
                'follow_up_questions' => [
                    'What is the difference between Big O, Big Theta, and Big Omega?',
                    'Can you give an example where an O(n^2) algorithm outperforms an O(n log n) one in practice?',
                    'How would you analyze the time complexity of a recursive function?',
                ],
                'related_topics' => ['Algorithm Analysis', 'Data Structures', 'Problem Solving'],
            ],
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
                    'detailed_explanation' => $question['detailed_explanation'],
                    'code_example' => $question['code_example'],
                    'follow_up_questions' => $question['follow_up_questions'],
                    'related_topics' => $question['related_topics'],
                ],
            );
        }
    }
}
