<?php

namespace App\Repositories\Skill;

use App\Helpers\QueryFilterHelper;
use App\Models\Skill;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SkillEloquent implements SkillContract
{
    protected $skill,$queryFilterHelper;
    public function __construct(Skill $skill,QueryFilterHelper $queryFilterHelper)
    {
        $this->skill = $skill;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->skill->query();
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['name', 'category', 'description']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['category']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->skill->query();
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['name', 'category', 'description']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['category']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Skill
    {
        return $this->skill->query()->find($id);
    }

    public function create(array $data): Skill
    {
        return $this->skill->create($data);
    }

    public function update(Skill $skill, array $data): Skill
    {
        $skill->update($data);

        return $skill->fresh([]);
    }

    public function delete(Skill $skill): bool
    {
        return (bool) $skill->delete();
    }
}
