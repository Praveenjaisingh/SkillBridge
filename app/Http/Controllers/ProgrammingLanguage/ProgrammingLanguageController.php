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
    protected $programmingLanguageInterface;
    public function __construct(ProgrammingLanguageInterface $programmingLanguageInterface)
    {
        $this->programmingLanguageInterface = $programmingLanguageInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $programmingLanguages = $this->programmingLanguageInterface->paginate(
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

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            ]);

            $this->programmingLanguageInterface->create($data);

            return redirect()->route('programming-languages.index')->with('success', 'ProgrammingLanguage created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $programmingLanguage = $this->programmingLanguageInterface->find((int) $id);

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

    public function edit(string $id): Response
    {
        try {
            $programmingLanguage = $this->programmingLanguageInterface->find((int) $id);

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

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255',
            'icon' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            ]);

            $this->programmingLanguageInterface->update((int) $id, $data);

            return redirect()->route('programming-languages.index')->with('success', 'ProgrammingLanguage updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->programmingLanguageInterface->delete((int) $id);

            return redirect()->route('programming-languages.index')->with('success', 'ProgrammingLanguage deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
