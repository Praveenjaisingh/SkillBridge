<?php

namespace App\Repositories\JobApplication;

use App\Models\JobApplication;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface JobApplicationContract
{
    /**
     * Get all JobApplication records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of JobApplication records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a JobApplication by its primary key.
     */
    public function find(int $id): ?JobApplication;

    /**
     * Create a new JobApplication record.
     */
    public function create(array $data): JobApplication;

    /**
     * Update an existing JobApplication record.
     */
    public function update(JobApplication $jobApplication, array $data): JobApplication;

    /**
     * Delete a JobApplication record.
     */
    public function delete(JobApplication $jobApplication): bool;
}
