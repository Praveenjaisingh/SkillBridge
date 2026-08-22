<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface QuizContract
{
    /**
     * Get all Quiz records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of Quiz records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a Quiz by its primary key.
     */
    public function find(int $id): ?Quiz;

    /**
     * Create a new Quiz record.
     */
    public function create(array $data): Quiz;

    /**
     * Update an existing Quiz record.
     */
    public function update(Quiz $quiz, array $data): Quiz;

    /**
     * Delete a Quiz record.
     */
    public function delete(Quiz $quiz): bool;
}
