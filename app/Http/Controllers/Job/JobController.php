<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Services\Job\JobInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class JobController extends Controller
{
    public function __construct(
        protected JobInterface $service,
        protected \App\Services\Company\CompanyInterface $companiesService,
        protected \App\Services\Skill\SkillInterface $skillsService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        try {
            $jobs = $this->service->paginate(
                $request->only(['search', 'job_type', 'experience_level', 'is_active', 'company_id']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('Job/Index', [
                'jobs' => $jobs,
                'filters' => $request->only(['search', 'job_type', 'experience_level', 'is_active', 'company_id']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Job/Index', [
                'jobs' => [],
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
            return Inertia::render('Job/Create', [
            'companies' => $this->companiesService->list(),
            'skills' => $this->skillsService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Job/Create', [
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
            'company_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'job_type' => 'nullable|string|max:255',
            'experience_level' => 'nullable|string|max:255',
            'salary_min' => 'nullable|integer',
            'salary_max' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'skills' => 'nullable|array',
            ]);

            $this->service->create($data);

            return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
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
            $job = $this->service->find((int) $id);

            return Inertia::render('Job/Show', [
                'job' => $job,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Job/Show', [
                'job' => null,
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
            $job = $this->service->find((int) $id);

            return Inertia::render('Job/Edit', [
                'job' => $job,
            'companies' => $this->companiesService->list(),
            'skills' => $this->skillsService->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Job/Edit', [
                'job' => null,
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
            'company_id' => 'sometimes|required|integer',
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|required|string',
            'requirements' => 'sometimes|nullable|string',
            'location' => 'sometimes|nullable|string|max:255',
            'job_type' => 'sometimes|nullable|string|max:255',
            'experience_level' => 'sometimes|nullable|string|max:255',
            'salary_min' => 'sometimes|nullable|integer',
            'salary_max' => 'sometimes|nullable|integer',
            'is_active' => 'sometimes|nullable|boolean',
            'skills' => 'sometimes|nullable|array',
            ]);

            $this->service->update((int) $id, $data);

            return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
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

            return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
