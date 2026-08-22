<?php

namespace App\Repositories\Quiz;

use App\Helpers\QueryFilterHelper;
use App\Models\Quiz;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class QuizEloquent implements QuizContract
{
    public function all(array $filters = []): Collection
    {
        $query = Quiz::query()->with(['course']);

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['title']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['course_id']);

        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Quiz::query()->with(['course']);

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['title']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['course_id']);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Quiz
    {
        return Quiz::query()->with(['course'])->find($id);
    }

    public function create(array $data): Quiz
    {
        return Quiz::create($data);
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
