<?php

namespace App\Repositories\ProgrammingLanguage;

use App\Models\ProgrammingLanguage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProgrammingLanguageContract
{
    /**
     * Get all ProgrammingLanguage records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of ProgrammingLanguage records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a ProgrammingLanguage by its primary key.
     */
    public function find(int $id): ?ProgrammingLanguage;

    /**
     * Create a new ProgrammingLanguage record.
     */
    public function create(array $data): ProgrammingLanguage;

    /**
     * Update an existing ProgrammingLanguage record.
     */
    public function update(ProgrammingLanguage $programmingLanguage, array $data): ProgrammingLanguage;

    /**
     * Delete a ProgrammingLanguage record.
     */
    public function delete(ProgrammingLanguage $programmingLanguage): bool;
}
