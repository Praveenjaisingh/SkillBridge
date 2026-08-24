<?php

namespace App\Repositories\ProgrammingLanguage;

use App\Models\ProgrammingLanguage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProgrammingLanguageContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?ProgrammingLanguage;
    public function create(array $data): ProgrammingLanguage;
    public function update(ProgrammingLanguage $programmingLanguage, array $data): ProgrammingLanguage;
    public function delete(ProgrammingLanguage $programmingLanguage): bool;
}
