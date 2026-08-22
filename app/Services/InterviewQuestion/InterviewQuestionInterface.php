<?php

namespace App\Services\InterviewQuestion;

use App\Models\InterviewQuestion;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface InterviewQuestionInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): InterviewQuestion;

    public function create(array $data): InterviewQuestion;

    public function update(int $id, array $data): InterviewQuestion;

    public function delete(int $id): bool;
}
