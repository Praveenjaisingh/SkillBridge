<?php

namespace App\Repositories\CodingProblem;

use App\Helpers\QueryFilterHelper;
use App\Models\CodingProblem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CodingProblemEloquent implements CodingProblemContract
{
    protected $codingProblem,$queryFilterHelper;
    public function __construct(CodingProblem $codingProblem,QueryFilterHelper $queryFilterHelper)
    {
        $this->codingProblem = $codingProblem;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->codingProblem->query()->with(['skill', 'programmingLanguage']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title', 'description']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['difficulty', 'skill_id', 'programming_language_id']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->codingProblem->query()->with(['skill', 'programmingLanguage']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title', 'description']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['difficulty', 'skill_id', 'programming_language_id']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?CodingProblem
    {
        return $this->codingProblem->query()->with(['skill', 'programmingLanguage'])->find($id);
    }

    public function create(array $data): CodingProblem
    {
        return $this->codingProblem->create($data);
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
