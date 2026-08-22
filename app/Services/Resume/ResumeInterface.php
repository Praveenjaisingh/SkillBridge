<?php

namespace App\Services\Resume;

use App\Models\Resume;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ResumeInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Resume;

    public function create(array $data): Resume;

    public function update(int $id, array $data): Resume;

    public function delete(int $id): bool;
}
