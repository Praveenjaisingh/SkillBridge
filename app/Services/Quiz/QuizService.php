<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Repositories\Quiz\QuizContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class QuizService implements QuizInterface
{
    protected $quizContract;
    public function __construct(QuizContract $quizContract)
    {
        $this->quizContract = $quizContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->quizContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->quizContract->paginate($filters, $perPage);
    }

    public function find(int $id): Quiz
    {
        $quiz = $this->quizContract->find($id);

        if (! $quiz) {
            throw new ModelNotFoundException("Quiz #{$id} not found.");
        }
        return $quiz;
    }

    public function create(array $data): Quiz
    {
        $quiz = $this->quizContract->create($data);
        return $quiz;
    }

    public function update(int $id, array $data): Quiz
    {
        $model = $this->find($id);
        $model = $this->quizContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->quizContract->delete($model);
    }
}
