<?php

namespace App\Services\Course;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CourseInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Course;

    public function create(array $data): Course;

    public function update(int $id, array $data): Course;

    public function delete(int $id): bool;
}
