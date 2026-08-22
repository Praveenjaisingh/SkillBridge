<?php

namespace App\Services\Lesson;

use App\Helpers\SlugHelper;
use App\Models\Lesson;
use App\Repositories\Lesson\LessonContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class LessonService implements LessonInterface
{
    public function __construct(
        protected LessonContract $repository
    ) {
    }

    public function list(array $filters = []): Collection
    {
        return $this->repository->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($filters, $perPage);
    }

    public function find(int $id): Lesson
    {
        $lesson = $this->repository->find($id);

        if (! $lesson) {
            throw new ModelNotFoundException("Lesson #{$id} not found.");
        }

        return $lesson;
    }

    public function create(array $data): Lesson
    {
        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], Lesson::class);
        }

        $lesson = $this->repository->create($data);

        return $lesson;
    }

    public function update(int $id, array $data): Lesson
    {
        $model = $this->find($id);

        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], Lesson::class, $id);
        }

        $model = $this->repository->update($model, $data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        return $this->repository->delete($model);
    }
}
