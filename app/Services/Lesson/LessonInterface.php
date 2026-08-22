<?php

namespace App\Services\Lesson;

use App\Models\Lesson;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface LessonInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Lesson;

    public function create(array $data): Lesson;

    public function update(int $id, array $data): Lesson;

    public function delete(int $id): bool;
}
