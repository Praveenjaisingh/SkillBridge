<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Controllers\Controller;
use App\Services\Lesson\LessonInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class LessonController extends Controller
{
    public function __construct(
        protected LessonInterface $service,
        protected \App\Services\Course\CourseInterface $coursesService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        try {
            $lessons = $this->service->paginate(
                $request->only(['search', 'course_id']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('Lesson/Index', [
                'lessons' => $lessons,
                'filters' => $request->only(['search', 'course_id']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Lesson/Index', [
                'lessons' => [],
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
            return Inertia::render('Lesson/Create', [
            'courses' => $this->coursesService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Lesson/Create', [
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
            'course_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'duration_minutes' => 'nullable|integer',
            ]);

            $this->service->create($data);

            return redirect()->route('lessons.index')->with('success', 'Lesson created successfully.');
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
            $lesson = $this->service->find((int) $id);

            return Inertia::render('Lesson/Show', [
                'lesson' => $lesson,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Lesson/Show', [
                'lesson' => null,
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
            $lesson = $this->service->find((int) $id);

            return Inertia::render('Lesson/Edit', [
                'lesson' => $lesson,
            'courses' => $this->coursesService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Lesson/Edit', [
                'lesson' => null,
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
            'course_id' => 'sometimes|required|integer',
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255',
            'content' => 'sometimes|nullable|string',
            'video_url' => 'sometimes|nullable|string|max:255',
            'order' => 'sometimes|nullable|integer',
            'duration_minutes' => 'sometimes|nullable|integer',
            ]);

            $this->service->update((int) $id, $data);

            return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully.');
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

            return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
