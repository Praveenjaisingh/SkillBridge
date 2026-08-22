<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CompanyInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Company;

    public function create(array $data): Company;

    public function update(int $id, array $data): Company;

    public function delete(int $id): bool;
}
