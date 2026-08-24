<?php

namespace App\Repositories\Company;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CompanyContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Company;
    public function create(array $data): Company;
    public function update(Company $company, array $data): Company;
    public function delete(Company $company): bool;
}
