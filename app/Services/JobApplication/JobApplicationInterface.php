<?php

namespace App\Services\JobApplication;

use App\Models\JobApplication;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface JobApplicationInterface
{
    public function list(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): JobApplication;
    public function create(array $data): JobApplication;
    public function update(int $id, array $data): JobApplication;
    public function delete(int $id): bool;
}
