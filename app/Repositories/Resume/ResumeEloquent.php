<?php

namespace App\Repositories\Resume;

use App\Helpers\QueryFilterHelper;
use App\Models\Resume;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ResumeEloquent implements ResumeContract
{
    protected $resume,$queryFilterHelper;
    public function __construct(Resume $resume,QueryFilterHelper $queryFilterHelper)
    {
        $this->resume = $resume;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->resume->query()->with(['user']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['user_id']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->resume->query()->with(['user']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['user_id']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Resume
    {
        return $this->resume->query()->with(['user'])->find($id);
    }

    public function create(array $data): Resume
    {
        return $this->resume->create($data);
    }

    public function update(Resume $resume, array $data): Resume
    {
        $resume->update($data);

        return $resume->fresh(['user']);
    }

    public function delete(Resume $resume): bool
    {
        return (bool) $resume->delete();
    }
}
