<?php

namespace App\Http\Controllers\Skill;

use App\Http\Controllers\Controller;
use App\Services\Skill\SkillInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class SkillController extends Controller
{
    protected $skillInterface;
    public function __construct(SkillInterface $skillInterface)
    {
        $this->skillInterface = $skillInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $skills = $this->skillInterface->paginate(
                $request->only(['search', 'category']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('Skill/Index', [
                'skills' => $skills,
                'filters' => $request->only(['search', 'category']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Skill/Index', [
                'skills' => [],
                'filters' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function create(): Response
    {
        try {
            return Inertia::render('Skill/Create', [
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Skill/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            ]);

            $this->skillInterface->create($data);

            return redirect()->route('skills.index')->with('success', 'Skill created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function show(string $id): Response
    {
        try {
            $skill = $this->skillInterface->find((int) $id);

            return Inertia::render('Skill/Show', [
                'skill' => $skill,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Skill/Show', [
                'skill' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function edit(string $id): Response
    {
        try {
            $skill = $this->skillInterface->find((int) $id);

            return Inertia::render('Skill/Edit', [
                'skill' => $skill,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Skill/Edit', [
                'skill' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255',
            'category' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            ]);

            $this->skillInterface->update((int) $id, $data);

            return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->skillInterface->delete((int) $id);

            return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
