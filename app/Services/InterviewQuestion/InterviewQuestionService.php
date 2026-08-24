<?php

namespace App\Services\InterviewQuestion;

use App\Models\InterviewQuestion;
use App\Repositories\InterviewQuestion\InterviewQuestionContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class InterviewQuestionService implements InterviewQuestionInterface
{
    protected $interviewQuestionContract;
    public function __construct(InterviewQuestionContract $interviewQuestionContract)
    {
        $this->interviewQuestionContract = $interviewQuestionContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->interviewQuestionContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->interviewQuestionContract->paginate($filters, $perPage);
    }

    public function find(int $id): InterviewQuestion
    {
        $interviewQuestion = $this->interviewQuestionContract->find($id);
        if (! $interviewQuestion) {
            throw new ModelNotFoundException("InterviewQuestion #{$id} not found.");
        }
        return $interviewQuestion;
    }

    public function create(array $data): InterviewQuestion
    {
        $interviewQuestion = $this->interviewQuestionContract->create($data);
        return $interviewQuestion;
    }

    public function update(int $id, array $data): InterviewQuestion
    {
        $model = $this->find($id);
        $model = $this->interviewQuestionContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->interviewQuestionContract->delete($model);
    }
}
