<?php

namespace App\Http\Controllers\ProgrammingLanguage;

use App\Http\Controllers\Controller;
use App\Services\ProgrammingLanguage\ProgrammingLanguageInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ProgrammingLanguageController extends Controller
{
    public function __construct(
        protected ProgrammingLanguageInterface $service,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        try {
            $programmingLanguages = $this->service->paginate(
                $request->only(['search', ]),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('ProgrammingLanguage/Index', [
                'programmingLanguages' => $programmingLanguages,
                'filters' => $request->only(['search', ]),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('ProgrammingLanguage/Index', [
                'programmingLanguages' => [],
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
            return Inertia::render('ProgrammingLanguage/Create', [
            ]);
        } catch (Throwable $e) {
            return Inertia::render('ProgrammingLanguage/Create', [
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
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            ]);

            $this->service->create($data);

            return redirect()->route('programming-languages.index')->with('success', 'ProgrammingLanguage created successfully.');
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
            $programmingLanguage = $this->service->find((int) $id);

            return Inertia::render('ProgrammingLanguage/Show', [
                'programmingLanguage' => $programmingLanguage,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('ProgrammingLanguage/Show', [
                'programmingLanguage' => null,
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
            $programmingLanguage = $this->service->find((int) $id);

            return Inertia::render('ProgrammingLanguage/Edit', [
                'programmingLanguage' => $programmingLanguage,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('ProgrammingLanguage/Edit', [
                'programmingLanguage' => null,
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
            'icon' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            ]);

            $this->service->update((int) $id, $data);

            return redirect()->route('programming-languages.index')->with('success', 'ProgrammingLanguage updated successfully.');
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

            return redirect()->route('programming-languages.index')->with('success', 'ProgrammingLanguage deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
