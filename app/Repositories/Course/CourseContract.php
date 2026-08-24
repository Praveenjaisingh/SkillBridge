<?php

namespace App\Repositories\Course;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CourseContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Course;
    public function create(array $data): Course;
    public function update(Course $course, array $data): Course;
    public function delete(Course $course): bool;
}
