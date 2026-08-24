<?php

namespace App\Repositories\Lesson;

use App\Models\Lesson;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface LessonContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Lesson;
    public function create(array $data): Lesson;
    public function update(Lesson $lesson, array $data): Lesson;
    public function delete(Lesson $lesson): bool;
}
