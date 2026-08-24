<?php

namespace App\Http\Controllers\JobApplication;

use App\Http\Controllers\Controller;
use App\Services\JobApplication\JobApplicationInterface;
use App\Services\Job\JobInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class JobApplicationController extends Controller
{
    protected  $jobApplicationInterface,$jobsInterface;
    public function __construct(JobApplicationInterface $jobApplicationInterface,JobInterface $jobsInterface) 
    {
         $this->jobApplicationInterface = $jobApplicationInterface;
        $this->jobsInterface = $jobsInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $jobApplications = $this->jobApplicationInterface->paginate(
                $request->only(['search', 'status', 'job_id', 'user_id']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('JobApplication/Index', [
                'jobApplications' => $jobApplications,
                'filters' => $request->only(['search', 'status', 'job_id', 'user_id']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('JobApplication/Index', [
                'jobApplications' => [],
                'filters' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function create(): Response
    {
        try {
            return Inertia::render('JobApplication/Create', [
            'jobs' => $this->jobsInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('JobApplication/Create', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
            'job_id' => 'required|integer',
            'user_id' => 'required|integer',
            'resume_id' => 'nullable|integer',
            'cover_letter' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            ]);

            $this->jobApplicationInterface->create($data);

            return redirect()->route('job-applications.index')->with('success', 'JobApplication created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $jobApplication = $this->jobApplicationInterface->find((int) $id);

            return Inertia::render('JobApplication/Show', [
                'jobApplication' => $jobApplication,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('JobApplication/Show', [
                'jobApplication' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function edit(string $id): Response
    {
        try {
            $jobApplication = $this->jobApplicationInterface->find((int) $id);

            return Inertia::render('JobApplication/Edit', [
                'jobApplication' => $jobApplication,
            'jobs' => $this->jobsInterface->list(),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('JobApplication/Edit', [
                'jobApplication' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validate([
            'job_id' => 'sometimes|required|integer',
            'user_id' => 'sometimes|required|integer',
            'resume_id' => 'sometimes|nullable|integer',
            'cover_letter' => 'sometimes|nullable|string',
            'status' => 'sometimes|nullable|string|max:255',
            ]);

            $this->jobApplicationInterface->update((int) $id, $data);

            return redirect()->route('job-applications.index')->with('success', 'JobApplication updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->jobApplicationInterface->delete((int) $id);

            return redirect()->route('job-applications.index')->with('success', 'JobApplication deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
