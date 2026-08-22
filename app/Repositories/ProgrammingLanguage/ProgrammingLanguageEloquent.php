<?php

namespace App\Repositories\ProgrammingLanguage;

use App\Helpers\QueryFilterHelper;
use App\Models\ProgrammingLanguage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProgrammingLanguageEloquent implements ProgrammingLanguageContract
{
    public function all(array $filters = []): Collection
    {
        $query = ProgrammingLanguage::query();

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['name', 'description']);

        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ProgrammingLanguage::query();

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['name', 'description']);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?ProgrammingLanguage
    {
        return ProgrammingLanguage::query()->find($id);
    }

    public function create(array $data): ProgrammingLanguage
    {
        return ProgrammingLanguage::create($data);
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
