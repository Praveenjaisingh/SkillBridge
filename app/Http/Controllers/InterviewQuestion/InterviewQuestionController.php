<?php

namespace App\Http\Controllers\InterviewQuestion;

use App\Http\Controllers\Controller;
use App\Services\InterviewQuestion\InterviewQuestionInterface;
use App\Services\Skill\SkillInterface;
use App\Services\ProgrammingLanguage\ProgrammingLanguageInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class InterviewQuestionController extends Controller
{
    protected $interviewQuestionInterface,$skillsInterface,$programmingLanguagesInterface;
    public function __construct(InterviewQuestionInterface $interviewQuestionInterface,SkillInterface $skillsInterface,ProgrammingLanguageInterface $programmingLanguagesInterface) 
    {
        $this->interviewQuestionInterface == $interviewQuestionInterface;
        $this->skillsInterface =$skillsInterface;
        $this->programmingLanguagesInterface=$programmingLanguagesInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $interviewQuestions = $this->interviewQuestionInterface->paginate(
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

    public function create(): Response
    {
        try {
            return Inertia::render('InterviewQuestion/Create', [
            'skills' => $this->skillsInterface->list(),
            'programmingLanguages' => $this->programmingLanguagesInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('InterviewQuestion/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

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

            $this->interviewQuestionInterface->create($data);

            return redirect()->route('interview-questions.index')->with('success', 'InterviewQuestion created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $interviewQuestion = $this->interviewQuestionInterface->find((int) $id);

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

    public function edit(string $id): Response
    {
        try {
            $interviewQuestion = $this->interviewQuestionInterface->find((int) $id);

            return Inertia::render('InterviewQuestion/Edit', [
                'interviewQuestion' => $interviewQuestion,
            'skills' => $this->skillsInterface->list(),
            'programmingLanguages' => $this->programmingLanguagesInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('InterviewQuestion/Edit', [
                'interviewQuestion' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

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

            $this->interviewQuestionInterface->update((int) $id, $data);

            return redirect()->route('interview-questions.index')->with('success', 'InterviewQuestion updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->interviewQuestionInterface->delete((int) $id);

            return redirect()->route('interview-questions.index')->with('success', 'InterviewQuestion deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
