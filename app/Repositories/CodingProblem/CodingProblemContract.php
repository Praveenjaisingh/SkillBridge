<?php

namespace App\Repositories\CodingProblem;

use App\Models\CodingProblem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CodingProblemContract
{
    /**
     * Get all CodingProblem records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of CodingProblem records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a CodingProblem by its primary key.
     */
    public function find(int $id): ?CodingProblem;

    /**
     * Create a new CodingProblem record.
     */
    public function create(array $data): CodingProblem;

    /**
     * Update an existing CodingProblem record.
     */
    public function update(CodingProblem $codingProblem, array $data): CodingProblem;

    /**
     * Delete a CodingProblem record.
     */
    public function delete(CodingProblem $codingProblem): bool;
}
