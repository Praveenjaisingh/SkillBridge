<?php

namespace App\Services\Job;

use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface JobInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Job;

    public function create(array $data): Job;

    public function update(int $id, array $data): Job;

    public function delete(int $id): bool;
}
