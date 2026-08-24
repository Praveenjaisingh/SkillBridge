<?php

namespace App\Repositories\Quiz;

use App\Helpers\QueryFilterHelper;
use App\Models\Quiz;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class QuizEloquent implements QuizContract
{
    protected $quiz,$queryFilterHelper;
    public function __construct(Quiz $quiz,QueryFilterHelper $queryFilterHelper)
    {
        $this->quiz = $quiz;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->quiz->query()->with(['course']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['course_id']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->quiz->query()->with(['course']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['course_id']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Quiz
    {
        return $this->quiz->query()->with(['course'])->find($id);
    }

    public function create(array $data): Quiz
    {
        return $this->quiz->create($data);
    }

    public function update(Quiz $quiz, array $data): Quiz
    {
        $quiz->update($data);

        return $quiz->fresh(['course']);
    }

    public function delete(Quiz $quiz): bool
    {
        return (bool) $quiz->delete();
    }
}
