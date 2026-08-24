<?php

namespace App\Repositories\ProgrammingLanguage;

use App\Helpers\QueryFilterHelper;
use App\Models\ProgrammingLanguage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProgrammingLanguageEloquent implements ProgrammingLanguageContract
{
    protected $programmingLanguage,$queryFilterHelper;
    public function __construct(ProgrammingLanguage $programmingLanguage,QueryFilterHelper $queryFilterHelper)
    {
        $this->programmingLanguage = $programmingLanguage;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->programmingLanguage->query();
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['name', 'description']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->programmingLanguage->query();
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['name', 'description']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?ProgrammingLanguage
    {
        return $this->programmingLanguage->query()->find($id);
    }

    public function create(array $data): ProgrammingLanguage
    {
        return $this->programmingLanguage->create($data);
    }

    public function update(ProgrammingLanguage $programmingLanguage, array $data): ProgrammingLanguage
    {
        $programmingLanguage->update($data);

        return $programmingLanguage->fresh([]);
    }

    public function delete(ProgrammingLanguage $programmingLanguage): bool
    {
        return (bool) $programmingLanguage->delete();
    }
}
