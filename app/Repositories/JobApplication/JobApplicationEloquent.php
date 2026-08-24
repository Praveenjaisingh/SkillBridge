<?php

namespace App\Repositories\JobApplication;

use App\Helpers\QueryFilterHelper;
use App\Models\JobApplication;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class JobApplicationEloquent implements JobApplicationContract
{
    protected $jobApplication,$queryFilterHelper;
    public function __construct(JobApplication $jobApplication,QueryFilterHelper $queryFilterHelper)
    {
        $this->jobApplication = $jobApplication;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->jobApplication->query()->with(['job', 'user', 'resume']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['status', 'job_id', 'user_id']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->jobApplication->query()->with(['job', 'user', 'resume']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['status', 'job_id', 'user_id']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?JobApplication
    {
        return $this->jobApplication->query()->with(['job', 'user', 'resume'])->find($id);
    }

    public function create(array $data): JobApplication
    {
        return $this->jobApplication->create($data);
    }

    public function update(JobApplication $jobApplication, array $data): JobApplication
    {
        $jobApplication->update($data);

        return $jobApplication->fresh(['job', 'user', 'resume']);
    }

    public function delete(JobApplication $jobApplication): bool
    {
        return (bool) $jobApplication->delete();
    }
}
