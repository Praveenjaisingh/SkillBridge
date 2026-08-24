<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Services\Job\JobInterface;
use App\Services\Company\CompanyInterface; 
use App\Services\Skill\SkillInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class JobController extends Controller
{
    protected $jobInterface,$companiesInterface,$skillsInterface;
    public function __construct(JobInterface $jobInterface,CompanyInterface $companiesInterface,SkillInterface $skillsInterface,)
    {
        $this->jobInterface = $jobInterface;
        $this->companiesInterface = $companiesInterface;
        $this->skillsInterface = $skillsInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $jobs = $this->jobInterface->paginate(
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

    public function create(): Response
    {
        try {
            return Inertia::render('Job/Create', [
            'companies' => $this->companiesInterface->list(),
            'skills' => $this->skillsInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Job/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

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

            $this->jobInterface->create($data);

            return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $job = $this->jobInterface->find((int) $id);

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

    public function edit(string $id): Response
    {
        try {
            $job = $this->jobInterface->find((int) $id);

            return Inertia::render('Job/Edit', [
                'job' => $job,
            'companies' => $this->companiesInterface->list(),
            'skills' => $this->skillsInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Job/Edit', [
                'job' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

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

            $this->jobInterface->update((int) $id, $data);

            return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->jobInterface->delete((int) $id);

            return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
