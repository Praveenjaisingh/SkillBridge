<?php

namespace App\Services\InterviewQuestion;

use App\Models\InterviewQuestion;
use App\Repositories\InterviewQuestion\InterviewQuestionContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class InterviewQuestionService implements InterviewQuestionInterface
{
    public function __construct(
        protected InterviewQuestionContract $repository
    ) {
    }

    public function list(array $filters = []): Collection
    {
        return $this->repository->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($filters, $perPage);
    }

    public function find(int $id): InterviewQuestion
    {
        $interviewQuestion = $this->repository->find($id);

        if (! $interviewQuestion) {
            throw new ModelNotFoundException("InterviewQuestion #{$id} not found.");
        }

        return $interviewQuestion;
    }

    public function create(array $data): InterviewQuestion
    {
        $interviewQuestion = $this->repository->create($data);

        return $interviewQuestion;
    }

    public function update(int $id, array $data): InterviewQuestion
    {
        $model = $this->find($id);

        $model = $this->repository->update($model, $data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        return $this->repository->delete($model);
    }
}
