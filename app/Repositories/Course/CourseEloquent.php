<?php

namespace App\Repositories\Course;

use App\Helpers\QueryFilterHelper;
use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CourseEloquent implements CourseContract
{
    public function all(array $filters = []): Collection
    {
        $query = Course::query()->with(['instructor', 'programmingLanguage', 'skills']);

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['title', 'description']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['level', 'is_published', 'programming_language_id']);

        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Course::query()->with(['instructor', 'programmingLanguage', 'skills']);

        $query = QueryFilterHelper::applySearch($query, $filters['search'] ?? null, ['title', 'description']);
        $query = QueryFilterHelper::applyFilters($query, $filters, ['level', 'is_published', 'programming_language_id']);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Course
    {
        return Course::query()->with(['instructor', 'programmingLanguage', 'skills'])->find($id);
    }

    public function create(array $data): Course
    {
        return Course::create($data);
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
