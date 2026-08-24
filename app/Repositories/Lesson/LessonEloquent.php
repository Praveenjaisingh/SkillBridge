<?php

namespace App\Repositories\Lesson;

use App\Helpers\QueryFilterHelper;
use App\Models\Lesson;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class LessonEloquent implements LessonContract
{
    protected $lesson,$queryFilterHelper;
    public function __construct(Lesson $lesson,QueryFilterHelper $queryFilterHelper)
    {
        $this->lesson = $lesson;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->lesson->query()->with(['course']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['course_id']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->lesson->query()->with(['course']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['course_id']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Lesson
    {
        return $this->lesson->query()->with(['course'])->find($id);
    }

    public function create(array $data): Lesson
    {
        return $this->lesson->create($data);
    }

    public function update(Lesson $lesson, array $data): Lesson
    {
        $lesson->update($data);

        return $lesson->fresh(['course']);
    }

    public function delete(Lesson $lesson): bool
    {
        return (bool) $lesson->delete();
    }
}
