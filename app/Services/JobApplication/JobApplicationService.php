<?php

namespace App\Services\JobApplication;

use App\Models\JobApplication;
use App\Repositories\JobApplication\JobApplicationContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class JobApplicationService implements JobApplicationInterface
{
    public function __construct(
        protected JobApplicationContract $repository
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

    public function find(int $id): JobApplication
    {
        $jobApplication = $this->repository->find($id);

        if (! $jobApplication) {
            throw new ModelNotFoundException("JobApplication #{$id} not found.");
        }

        return $jobApplication;
    }

    public function create(array $data): JobApplication
    {
        $jobApplication = $this->repository->create($data);

        return $jobApplication;
    }

    public function update(int $id, array $data): JobApplication
    {
        $model = $this->find($id);

        $model = $this->repository->update($model, $data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        return $this->repository->delete($model);
    }
}
