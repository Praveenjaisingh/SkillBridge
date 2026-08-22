<?php

namespace App\Repositories\JobApplication;

use App\Helpers\QueryFilterHelper;
use App\Models\JobApplication;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class JobApplicationEloquent implements JobApplicationContract
{
    public function all(array $filters = []): Collection
    {
        $query = JobApplication::query()->with(['job', 'user', 'resume']);

        $query = QueryFilterHelper::applyFilters($query, $filters, ['status', 'job_id', 'user_id']);

        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = JobApplication::query()->with(['job', 'user', 'resume']);

        $query = QueryFilterHelper::applyFilters($query, $filters, ['status', 'job_id', 'user_id']);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?JobApplication
    {
        return JobApplication::query()->with(['job', 'user', 'resume'])->find($id);
    }

    public function create(array $data): JobApplication
    {
        return JobApplication::create($data);
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
