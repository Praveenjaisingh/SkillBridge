<?php

namespace App\Repositories\Lesson;

use App\Models\Lesson;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface LessonContract
{
    /**
     * Get all Lesson records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of Lesson records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a Lesson by its primary key.
     */
    public function find(int $id): ?Lesson;

    /**
     * Create a new Lesson record.
     */
    public function create(array $data): Lesson;

    /**
     * Update an existing Lesson record.
     */
    public function update(Lesson $lesson, array $data): Lesson;

    /**
     * Delete a Lesson record.
     */
    public function delete(Lesson $lesson): bool;
}
