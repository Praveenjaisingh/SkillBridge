<?php

namespace App\Repositories\Job;

use App\Helpers\QueryFilterHelper;
use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class JobEloquent implements JobContract
{
    protected $job,$queryFilterHelper;
    public function __construct(Job $job,QueryFilterHelper $queryFilterHelper)
    {
        $this->job = $job;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->job->query()->with(['company', 'postedBy', 'skills']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title', 'location', 'description']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['job_type', 'experience_level', 'is_active', 'company_id']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->job->query()->with(['company', 'postedBy', 'skills']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['title', 'location', 'description']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['job_type', 'experience_level', 'is_active', 'company_id']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Job
    {
        return $this->job->query()->with(['company', 'postedBy', 'skills'])->find($id);
    }

    public function create(array $data): Job
    {
        return $this->job->create($data);
    }

    public function update(Job $job, array $data): Job
    {
        $job->update($data);

        return $job->fresh(['company', 'postedBy', 'skills']);
    }

    public function delete(Job $job): bool
    {
        return (bool) $job->delete();
    }
}
