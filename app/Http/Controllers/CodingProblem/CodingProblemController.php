<?php

namespace App\Http\Controllers\CodingProblem;

use App\Http\Controllers\Controller;
use App\Services\CodingProblem\CodingProblemInterface;
use App\Services\Skill\SkillInterface;
use App\Services\ProgrammingLanguage\ProgrammingLanguageInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class CodingProblemController extends Controller
{
    protected $codingProblemInterface,$skillsInterface,$programmingLanguagesInterface;
    public function __construct(CodingProblemInterface $codingProblemInterface,SkillInterface $skillsInterface,ProgrammingLanguageInterface $programmingLanguagesInterface,) 
    {
        $this->codingProblemInterface = $codingProblemInterface;
        $this->skillsInterface = $skillsInterface;
        $this->programmingLanguagesInterface = $programmingLanguagesInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $codingProblems = $this->codingProblemInterface->paginate(
                $request->only(['search', 'difficulty', 'skill_id', 'programming_language_id']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('CodingProblem/Index', [
                'codingProblems' => $codingProblems,
                'filters' => $request->only(['search', 'difficulty', 'skill_id', 'programming_language_id']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('CodingProblem/Index', [
                'codingProblems' => [],
                'filters' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function create(): Response
    {
        try {
            return Inertia::render('CodingProblem/Create', [
            'skills' => $this->skillsInterface->list(),
            'programmingLanguages' => $this->programmingLanguagesInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('CodingProblem/Create', [
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
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'nullable|string|max:255',
            'sample_input' => 'nullable|string',
            'sample_output' => 'nullable|string',
            'constraints' => 'nullable|string',
            ]);

            $this->codingProblemInterface->create($data);

            return redirect()->route('coding-problems.index')->with('success', 'CodingProblem created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $codingProblem = $this->codingProblemInterface->find((int) $id);

            return Inertia::render('CodingProblem/Show', [
                'codingProblem' => $codingProblem,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('CodingProblem/Show', [
                'codingProblem' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function edit(string $id): Response
    {
        try {
            $codingProblem = $this->codingProblemInterface->find((int) $id);

            return Inertia::render('CodingProblem/Edit', [
                'codingProblem' => $codingProblem,
            'skills' => $this->skillsInterface->list(),
            'programmingLanguages' => $this->programmingLanguagesInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('CodingProblem/Edit', [
                'codingProblem' => null,
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
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|required|string',
            'difficulty' => 'sometimes|nullable|string|max:255',
            'sample_input' => 'sometimes|nullable|string',
            'sample_output' => 'sometimes|nullable|string',
            'constraints' => 'sometimes|nullable|string',
            ]);

            $this->codingProblemInterface->update((int) $id, $data);

            return redirect()->route('coding-problems.index')->with('success', 'CodingProblem updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->codingProblemInterface->delete((int) $id);

            return redirect()->route('coding-problems.index')->with('success', 'CodingProblem deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
