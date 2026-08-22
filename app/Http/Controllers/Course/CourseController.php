<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Services\Course\CourseInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class CourseController extends Controller
{
    public function __construct(
        protected CourseInterface $service,
        protected \App\Services\ProgrammingLanguage\ProgrammingLanguageInterface $programmingLanguagesService,
        protected \App\Services\Skill\SkillInterface $skillsService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        try {
            $courses = $this->service->paginate(
                $request->only(['search', 'level', 'is_published', 'programming_language_id']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('Course/Index', [
                'courses' => $courses,
                'filters' => $request->only(['search', 'level', 'is_published', 'programming_language_id']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Course/Index', [
                'courses' => [],
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
            return Inertia::render('Course/Create', [
            'programmingLanguages' => $this->programmingLanguagesService->list(),
            'skills' => $this->skillsService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Course/Create', [
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
            'programming_language_id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'duration_hours' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'is_published' => 'nullable|boolean',
            'skills' => 'nullable|array',
            ]);

            $this->service->create($data);

            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
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
            $course = $this->service->find((int) $id);

            return Inertia::render('Course/Show', [
                'course' => $course,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Course/Show', [
                'course' => null,
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
            $course = $this->service->find((int) $id);

            return Inertia::render('Course/Edit', [
                'course' => $course,
            'programmingLanguages' => $this->programmingLanguagesService->list(),
            'skills' => $this->skillsService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Course/Edit', [
                'course' => null,
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
            'programming_language_id' => 'sometimes|nullable|integer',
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            'thumbnail' => 'sometimes|nullable|string|max:255',
            'level' => 'sometimes|nullable|string|max:255',
            'duration_hours' => 'sometimes|nullable|integer',
            'price' => 'sometimes|nullable|numeric',
            'is_published' => 'sometimes|nullable|boolean',
            'skills' => 'sometimes|nullable|array',
            ]);

            $this->service->update((int) $id, $data);

            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
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

            return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
