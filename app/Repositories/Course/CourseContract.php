<?php

namespace App\Repositories\Course;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CourseContract
{
    /**
     * Get all Course records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of Course records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a Course by its primary key.
     */
    public function find(int $id): ?Course;

    /**
     * Create a new Course record.
     */
    public function create(array $data): Course;

    /**
     * Update an existing Course record.
     */
    public function update(Course $course, array $data): Course;

    /**
     * Delete a Course record.
     */
    public function delete(Course $course): bool;
}
