<?php

namespace App\Repositories\Resume;

use App\Models\Resume;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ResumeContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Resume;
    public function create(array $data): Resume;
    public function update(Resume $resume, array $data): Resume;
    public function delete(Resume $resume): bool;
}
