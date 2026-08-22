<?php

namespace App\Repositories\InterviewQuestion;

use App\Models\InterviewQuestion;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface InterviewQuestionContract
{
    /**
     * Get all InterviewQuestion records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of InterviewQuestion records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a InterviewQuestion by its primary key.
     */
    public function find(int $id): ?InterviewQuestion;

    /**
     * Create a new InterviewQuestion record.
     */
    public function create(array $data): InterviewQuestion;

    /**
     * Update an existing InterviewQuestion record.
     */
    public function update(InterviewQuestion $interviewQuestion, array $data): InterviewQuestion;

    /**
     * Delete a InterviewQuestion record.
     */
    public function delete(InterviewQuestion $interviewQuestion): bool;
}
