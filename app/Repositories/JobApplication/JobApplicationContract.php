<?php

namespace App\Repositories\JobApplication;

use App\Models\JobApplication;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface JobApplicationContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?JobApplication;
    public function create(array $data): JobApplication;
    public function update(JobApplication $jobApplication, array $data): JobApplication;
    public function delete(JobApplication $jobApplication): bool;
}
