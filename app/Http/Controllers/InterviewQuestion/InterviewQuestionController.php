<?php

namespace App\Http\Controllers\InterviewQuestion;

use App\Http\Controllers\Controller;
use App\Services\InterviewQuestion\InterviewQuestionInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class InterviewQuestionController extends Controller
{
    public function __construct(
        protected InterviewQuestionInterface $service,
        protected \App\Services\Skill\SkillInterface $skillsService,
        protected \App\Services\ProgrammingLanguage\ProgrammingLanguageInterface $programmingLanguagesService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        try {
            $interviewQuestions = $this->service->paginate(
                $request->only(['search', 'difficulty', 'skill_id', 'programming_language_id']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('InterviewQuestion/Index', [
                'interviewQuestions' => $interviewQuestions,
                'filters' => $request->only(['search', 'difficulty', 'skill_id', 'programming_language_id']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('InterviewQuestion/Index', [
                'interviewQuestions' => [],
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
            return Inertia::render('InterviewQuestion/Create', [
            'skills' => $this->skillsService->list(),
            'programmingLanguages' => $this->programmingLanguagesService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('InterviewQuestion/Create', [
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
            'skill_id' => 'nullable|integer',
            'programming_language_id' => 'nullable|integer',
            'question' => 'required|string',
            'answer' => 'nullable|string',
            'difficulty' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            ]);

            $this->service->create($data);

            return redirect()->route('interview-questions.index')->with('success', 'InterviewQuestion created successfully.');
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
            $interviewQuestion = $this->service->find((int) $id);

            return Inertia::render('InterviewQuestion/Show', [
                'interviewQuestion' => $interviewQuestion,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('InterviewQuestion/Show', [
                'interviewQuestion' => null,
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
            $interviewQuestion = $this->service->find((int) $id);

            return Inertia::render('InterviewQuestion/Edit', [
                'interviewQuestion' => $interviewQuestion,
            'skills' => $this->skillsService->list(),
            'programmingLanguages' => $this->programmingLanguagesService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('InterviewQuestion/Edit', [
                'interviewQuestion' => null,
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
            'skill_id' => 'sometimes|nullable|integer',
            'programming_language_id' => 'sometimes|nullable|integer',
            'question' => 'sometimes|required|string',
            'answer' => 'sometimes|nullable|string',
            'difficulty' => 'sometimes|nullable|string|max:255',
            'category' => 'sometimes|nullable|string|max:255',
            ]);

            $this->service->update((int) $id, $data);

            return redirect()->route('interview-questions.index')->with('success', 'InterviewQuestion updated successfully.');
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

            return redirect()->route('interview-questions.index')->with('success', 'InterviewQuestion deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
