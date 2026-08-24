<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Controllers\Controller;
use App\Services\Lesson\LessonInterface;
use App\Services\Course\CourseInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class LessonController extends Controller
{
    protected $lessonInterface,$coursesInterface;
    public function __construct(LessonInterface $lessonInterface,CourseInterface $coursesInterface) 
    {
        $this->lessonInterface = $lessonInterface;
        $this->coursesInterface = $coursesInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $lessons = $this->lessonInterface->paginate(
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

    public function create(): Response
    {
        try {
            return Inertia::render('Lesson/Create', [
            'courses' => $this->coursesInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Lesson/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

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

            $this->lessonInterface->create($data);

            return redirect()->route('lessons.index')->with('success', 'Lesson created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $lesson = $this->lessonInterface->find((int) $id);

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

    public function edit(string $id): Response
    {
        try {
            $lesson = $this->lessonInterface->find((int) $id);

            return Inertia::render('Lesson/Edit', [
                'lesson' => $lesson,
            'courses' => $this->coursesInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Lesson/Edit', [
                'lesson' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

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

            $this->lessonInterface->update((int) $id, $data);

            return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->lessonInterface->delete((int) $id);

            return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
