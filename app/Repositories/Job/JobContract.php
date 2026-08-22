<?php

namespace App\Repositories\Job;

use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface JobContract
{
    /**
     * Get all Job records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of Job records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a Job by its primary key.
     */
    public function find(int $id): ?Job;

    /**
     * Create a new Job record.
     */
    public function create(array $data): Job;

    /**
     * Update an existing Job record.
     */
    public function update(Job $job, array $data): Job;

    /**
     * Delete a Job record.
     */
    public function delete(Job $job): bool;
}
