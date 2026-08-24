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
    protected $lessonContract;
    public function __construct(LessonContract $lessonContract)
    {
        $this->lessonContract = $lessonContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->lessonContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->lessonContract->paginate($filters, $perPage);
    }

    public function find(int $id): Lesson
    {
        $lesson = $this->lessonContract->find($id);
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
        $lesson = $this->lessonContract->create($data);
        return $lesson;
    }

    public function update(int $id, array $data): Lesson
    {
        $model = $this->find($id);

        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], Lesson::class, $id);
        }
        $model = $this->lessonContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->lessonContract->delete($model);
    }
}
