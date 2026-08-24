<?php

namespace App\Repositories\Company;

use App\Helpers\QueryFilterHelper;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CompanyEloquent implements CompanyContract
{
    protected $company,$queryFilterHelper;
    public function __construct(Company $company,QueryFilterHelper $queryFilterHelper)
    {
        $this->company = $company;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->company->query();
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['name', 'location', 'industry']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['industry']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->company->query();
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['name', 'location', 'industry']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['industry']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Company
    {
        return $this->company->query()->find($id);
    }

    public function create(array $data): Company
    {
        return $this->company->create($data);
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
