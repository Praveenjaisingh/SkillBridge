<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Company\CompanyInterface;
use App\Helpers\PaginationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class CompanyController extends Controller
{
    protected $CompanyInterface;
    public function __construct(CompanyInterface $CompanyInterface,) 
    {
        $this->CompanyInterface = $CompanyInterface;
    }

    public function index(Request $request): Response
    {
        try {
            $companys = $this->CompanyInterface->paginate(
                $request->only(['search', 'industry']),
                PaginationHelper::perPage($request)
            );

            return Inertia::render('Company/Index', [
                'companys' => $companys,
                'filters' => $request->only(['search', 'industry']),
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Company/Index', [
                'companys' => [],
                'filters' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function create(): Response
    {
        try {
            return Inertia::render('Company/Create', [
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Company/Create', [
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
            'description' => 'nullable|string',
            'website' => 'nullable|string|max:255',
            'logo' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            ]);

            $this->CompanyInterface->create($data);

            return redirect()->route('companies.index')->with('success', 'Company created successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id): Response
    {
        try {
            $company = $this->CompanyInterface->find((int) $id);

            return Inertia::render('Company/Show', [
                'company' => $company,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Company/Show', [
                'company' => null,
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function edit(string $id): Response
    {
        try {
            $company = $this->CompanyInterface->find((int) $id);

            return Inertia::render('Company/Edit', [
                'company' => $company,
            ]);
        } catch (Throwable $e) {
            return Inertia::render('Company/Edit', [
                'company' => null,
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
            'description' => 'sometimes|nullable|string',
            'website' => 'sometimes|nullable|string|max:255',
            'logo' => 'sometimes|nullable|string|max:255',
            'location' => 'sometimes|nullable|string|max:255',
            'industry' => 'sometimes|nullable|string|max:255',
            ]);

            $this->CompanyInterface->update((int) $id, $data);

            return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->CompanyInterface->delete((int) $id);

            return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
