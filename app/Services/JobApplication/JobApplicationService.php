<?php

namespace App\Services\JobApplication;

use App\Models\JobApplication;
use App\Repositories\JobApplication\JobApplicationContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class JobApplicationService implements JobApplicationInterface
{
    protected $jobApplicationContract;
    public function __construct(JobApplicationContract $jobApplicationContract)
    {
        $this->jobApplicationContract = $jobApplicationContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->jobApplicationContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->jobApplicationContract->paginate($filters, $perPage);
    }

    public function find(int $id): JobApplication
    {
        $jobApplication = $this->jobApplicationContract->find($id);
        if (! $jobApplication) {
            throw new ModelNotFoundException("JobApplication #{$id} not found.");
        }
        return $jobApplication;
    }

    public function create(array $data): JobApplication
    {
        $jobApplication = $this->jobApplicationContract->create($data);
        return $jobApplication;
    }

    public function update(int $id, array $data): JobApplication
    {
        $model = $this->find($id);
        $model = $this->jobApplicationContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->jobApplicationContract->delete($model);
    }
}
