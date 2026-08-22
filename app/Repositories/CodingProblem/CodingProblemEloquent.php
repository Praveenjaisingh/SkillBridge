<?php

namespace App\Repositories\CodingProblem;

use App\Helpers\QueryFilterHelper;
use App\Models\CodingProblem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CodingProblemEloquent implements CodingProblemContract
{
    public function all(array $filters = []): Collection
    {
        $query = CodingProblem::query()->with(['skill', 'programmingLanguage']);

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['title', 'description']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['difficulty', 'skill_id', 'programming_language_id']);

        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = CodingProblem::query()->with(['skill', 'programmingLanguage']);

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['title', 'description']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['difficulty', 'skill_id', 'programming_language_id']);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?CodingProblem
    {
        return CodingProblem::query()->with(['skill', 'programmingLanguage'])->find($id);
    }

    public function create(array $data): CodingProblem
    {
        return CodingProblem::create($data);
    }

    public function update(CodingProblem $codingProblem, array $data): CodingProblem
    {
        $codingProblem->update($data);

        return $codingProblem->fresh(['skill', 'programmingLanguage']);
    }

    public function delete(CodingProblem $codingProblem): bool
    {
        return (bool) $codingProblem->delete();
    }
}
