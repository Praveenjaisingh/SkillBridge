<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Services\Course\CourseInterface;
use App\Services\ProgrammingLanguage\ProgrammingLanguageInterface;
use App\Services\Skill\SkillInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class CourseController extends Controller
{
    protected $courseInterface,$programmingLanguagesInterface,$skillsInterface;
    public function __construct(CourseInterface $courseInterface,ProgrammingLanguageInterface $programmingLanguagesInterface,SkillInterface $skillsInterface,) 
    {
        $this->courseInterface = $courseInterface;
        $this->skillsInterface = $skillsInterface;
        $this->programmingLanguagesInterface = $programmingLanguagesInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $courses = $this->courseInterface->paginate(
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

    public function create(): Response
    {
        try {
            return Inertia::render('Course/Create', [
            'programmingLanguages' => $this->programmingLanguagesInterface->list(),
            'skills' => $this->skillsInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Course/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

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

            $this->courseInterface->create($data);

            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $course = $this->courseInterface->find((int) $id);

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

    public function edit(string $id): Response
    {
        try {
            $course = $this->courseInterface->find((int) $id);

            return Inertia::render('Course/Edit', [
                'course' => $course,
            'programmingLanguages' => $this->programmingLanguagesInterface->list(),
            'skills' => $this->skillsInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Course/Edit', [
                'course' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

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

            $this->courseInterface->update((int) $id, $data);

            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->courseInterface->delete((int) $id);

            return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
