<?php

namespace App\Services\Course;

use App\Helpers\SlugHelper;
use App\Models\Course;
use App\Repositories\Course\CourseContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class CourseService implements CourseInterface
{
    public function __construct(
        protected CourseContract $repository
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

    public function find(int $id): Course
    {
        $course = $this->repository->find($id);

        if (! $course) {
            throw new ModelNotFoundException("Course #{$id} not found.");
        }

        return $course;
    }

    public function create(array $data): Course
    {
        $skillIds = $data['skills'] ?? null;
        unset($data['skills']);

        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], Course::class);
        }

        $course = $this->repository->create($data);

        if ($skillIds !== null) {
            $course->skills()->sync($skillIds);
            $course = $course->fresh(['instructor', 'programmingLanguage', 'skills']);
        }

        return $course;
    }

    public function update(int $id, array $data): Course
    {
        $model = $this->find($id);

        $skillIds = $data['skills'] ?? null;
        unset($data['skills']);

        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], Course::class, $id);
        }

        $model = $this->repository->update($model, $data);

        if ($skillIds !== null) {
            $model->skills()->sync($skillIds);
            $model = $model->fresh(['instructor', 'programmingLanguage', 'skills']);
        }

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        return $this->repository->delete($model);
    }
}
