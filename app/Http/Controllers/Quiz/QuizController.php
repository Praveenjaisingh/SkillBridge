<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Services\Quiz\QuizInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class QuizController extends Controller
{
    public function __construct(
        protected QuizInterface $service,
        protected \App\Services\Course\CourseInterface $coursesService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        try {
            $quizs = $this->service->paginate(
                $request->only(['search', 'course_id']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('Quiz/Index', [
                'quizs' => $quizs,
                'filters' => $request->only(['search', 'course_id']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Quiz/Index', [
                'quizs' => [],
                'filters' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        try {
            return Inertia::render('Quiz/Create', [
            'courses' => $this->coursesService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Quiz/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
            'course_id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'nullable|array',
            'passing_score' => 'nullable|integer',
            'time_limit_minutes' => 'nullable|integer',
            ]);

            $this->service->create($data);

            return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        try {
            $quiz = $this->service->find((int) $id);

            return Inertia::render('Quiz/Show', [
                'quiz' => $quiz,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Quiz/Show', [
                'quiz' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        try {
            $quiz = $this->service->find((int) $id);

            return Inertia::render('Quiz/Edit', [
                'quiz' => $quiz,
            'courses' => $this->coursesService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Quiz/Edit', [
                'quiz' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validate([
            'course_id' => 'sometimes|nullable|integer',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'questions' => 'sometimes|nullable|array',
            'passing_score' => 'sometimes|nullable|integer',
            'time_limit_minutes' => 'sometimes|nullable|integer',
            ]);

            $this->service->update((int) $id, $data);

            return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->service->delete((int) $id);

            return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
