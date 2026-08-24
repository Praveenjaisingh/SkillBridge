<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Services\Resume\ResumeInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ResumeController extends Controller
{
    protected $resumeInterface;
    public function __construct(ResumeInterface $resumeInterface)
    {
        $this->resumeInterface = $resumeInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $resumes = $this->resumeInterface->paginate(
                $request->only(['search', 'user_id']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('Resume/Index', [
                'resumes' => $resumes,
                'filters' => $request->only(['search', 'user_id']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Resume/Index', [
                'resumes' => [],
                'filters' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function create(): Response
    {
        try {
            return Inertia::render('Resume/Create', [
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Resume/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
            'is_primary' => 'nullable|boolean',
            ]);

            $this->resumeInterface->create($data);

            return redirect()->route('resumes.index')->with('success', 'Resume created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $resume = $this->resumeInterface->find((int) $id);

            return Inertia::render('Resume/Show', [
                'resume' => $resume,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Resume/Show', [
                'resume' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function edit(string $id): Response
    {
        try {
            $resume = $this->resumeInterface->find((int) $id);

            return Inertia::render('Resume/Edit', [
                'resume' => $resume,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Resume/Edit', [
                'resume' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|required|integer',
            'title' => 'sometimes|required|string|max:255',
            'file_path' => 'sometimes|required|string|max:255',
            'is_primary' => 'sometimes|nullable|boolean',
            ]);

            $this->resumeInterface->update((int) $id, $data);

            return redirect()->route('resumes.index')->with('success', 'Resume updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->resumeInterface->delete((int) $id);

            return redirect()->route('resumes.index')->with('success', 'Resume deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
