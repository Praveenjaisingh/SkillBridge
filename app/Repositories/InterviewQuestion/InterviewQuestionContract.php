<?php

namespace App\Repositories\InterviewQuestion;

use App\Models\InterviewQuestion;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface InterviewQuestionContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?InterviewQuestion;
    public function create(array $data): InterviewQuestion;
    public function update(InterviewQuestion $interviewQuestion, array $data): InterviewQuestion;
    public function delete(InterviewQuestion $interviewQuestion): bool;
}
