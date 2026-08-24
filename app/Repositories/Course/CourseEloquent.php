<?php

namespace App\Repositories\Course;

use App\Helpers\QueryFilterHelper;
use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CourseEloquent implements CourseContract
{
    protected $course,$queryFilterHelper;
    public function __construct(Course $course,QueryFilterHelper $queryFilterHelper)
    {
        $this->course = $course;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->course->query()->with(['instructor', 'programmingLanguage', 'skills']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title', 'description']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['level', 'is_published', 'programming_language_id']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->course->query()->with(['instructor', 'programmingLanguage', 'skills']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title', 'description']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['level', 'is_published', 'programming_language_id']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Course
    {
        return $this->course->query()->with(['instructor', 'programmingLanguage', 'skills'])->find($id);
    }

    public function create(array $data): Course
    {
        return $this->course->create($data);
    }

    public function update(Course $course, array $data): Course
    {
        $course->update($data);

        return $course->fresh(['instructor', 'programmingLanguage', 'skills']);
    }

    public function delete(Course $course): bool
    {
        return (bool) $course->delete();
    }
}
