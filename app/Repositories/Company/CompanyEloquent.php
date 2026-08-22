<?php

namespace App\Repositories\Company;

use App\Helpers\QueryFilterHelper;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CompanyEloquent implements CompanyContract
{
    public function all(array $filters = []): Collection
    {
        $query = Company::query();

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['name', 'location', 'industry']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['industry']);

        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Company::query();

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['name', 'location', 'industry']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['industry']);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Company
    {
        return Company::query()->find($id);
    }

    public function create(array $data): Company
    {
        return Company::create($data);
    }

    public function update(Company $company, array $data): Company
    {
        $company->update($data);

        return $company->fresh([]);
    }

    public function delete(Company $company): bool
    {
        return (bool) $company->delete();
    }
}
