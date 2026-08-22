<?php

namespace App\Services\ProgrammingLanguage;

use App\Models\ProgrammingLanguage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProgrammingLanguageInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): ProgrammingLanguage;

    public function create(array $data): ProgrammingLanguage;

    public function update(int $id, array $data): ProgrammingLanguage;

    public function delete(int $id): bool;
}
