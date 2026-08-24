<?php

namespace App\Repositories\Job;

use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface JobContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Job;
    public function create(array $data): Job;
    public function update(Job $job, array $data): Job;
    public function delete(Job $job): bool;
}
