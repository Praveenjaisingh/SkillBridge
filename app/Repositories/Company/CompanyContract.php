<?php

namespace App\Repositories\Company;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CompanyContract
{
    /**
     * Get all Company records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of Company records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a Company by its primary key.
     */
    public function find(int $id): ?Company;

    /**
     * Create a new Company record.
     */
    public function create(array $data): Company;

    /**
     * Update an existing Company record.
     */
    public function update(Company $company, array $data): Company;

    /**
     * Delete a Company record.
     */
    public function delete(Company $company): bool;
}
