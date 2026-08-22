<?php

namespace App\Repositories\Resume;

use App\Models\Resume;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ResumeContract
{
    /**
     * Get all Resume records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of Resume records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a Resume by its primary key.
     */
    public function find(int $id): ?Resume;

    /**
     * Create a new Resume record.
     */
    public function create(array $data): Resume;

    /**
     * Update an existing Resume record.
     */
    public function update(Resume $resume, array $data): Resume;

    /**
     * Delete a Resume record.
     */
    public function delete(Resume $resume): bool;
}
