<?php

namespace App\Services\Job;

use App\Helpers\SlugHelper;
use App\Models\Job;
use App\Repositories\Job\JobContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class JobService implements JobInterface
{
    protected $jobContract;
    public function __construct(JobContract $jobContract)
    {
        $this->jobContract = $jobContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->jobContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->jobContract->paginate($filters, $perPage);
    }

    public function find(int $id): Job
    {
        $job = $this->jobContract->find($id);
        if (! $job) {
            throw new ModelNotFoundException("Job #{$id} not found.");
        }
        return $job;
    }

    public function create(array $data): Job
    {
        $skillIds = $data['skills'] ?? null;
        unset($data['skills']);
        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], Job::class);
        }
        $job = $this->jobContract->create($data);

        if ($skillIds !== null) {
            $job->skills()->sync($skillIds);
            $job = $job->fresh(['company', 'postedBy', 'skills']);
        }
        return $job;
    }

    public function update(int $id, array $data): Job
    {
        $model = $this->find($id);
        $skillIds = $data['skills'] ?? null;
        unset($data['skills']);
        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], Job::class, $id);
        }
        $model = $this->jobContract->update($model, $data);
        if ($skillIds !== null) {
            $model->skills()->sync($skillIds);
            $model = $model->fresh(['company', 'postedBy', 'skills']);
        }
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->jobContract->delete($model);
    }
}
