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
    public function __construct(
        protected SkillInterface $service,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        try {
            $skills = $this->service->paginate(
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

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            ]);

            $this->service->create($data);

            return redirect()->route('skills.index')->with('success', 'Skill created successfully.');
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
            $skill = $this->service->find((int) $id);

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        try {
            $skill = $this->service->find((int) $id);

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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255',
            'category' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            ]);

            $this->service->update((int) $id, $data);

            return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
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

            return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
