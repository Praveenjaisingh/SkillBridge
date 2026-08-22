<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Repositories\Quiz\QuizContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class QuizService implements QuizInterface
{
    public function __construct(
        protected QuizContract $repository
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

    public function find(int $id): Quiz
    {
        $quiz = $this->repository->find($id);

        if (! $quiz) {
            throw new ModelNotFoundException("Quiz #{$id} not found.");
        }

        return $quiz;
    }

    public function create(array $data): Quiz
    {
        $quiz = $this->repository->create($data);

        return $quiz;
    }

    public function update(int $id, array $data): Quiz
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
