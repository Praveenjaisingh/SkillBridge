<?php

namespace App\Repositories\Resume;

use App\Helpers\QueryFilterHelper;
use App\Models\Resume;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ResumeEloquent implements ResumeContract
{
    public function all(array $filters = []): Collection
    {
        $query = Resume::query()->with(['user']);

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['title']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['user_id']);

        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Resume::query()->with(['user']);

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['title']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['user_id']);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Resume
    {
        return Resume::query()->with(['user'])->find($id);
    }

    public function create(array $data): Resume
    {
        return Resume::create($data);
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
