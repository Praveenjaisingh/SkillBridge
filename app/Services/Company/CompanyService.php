<?php

namespace App\Services\Company;

use App\Helpers\SlugHelper;
use App\Models\Company;
use App\Repositories\Company\CompanyContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class CompanyService implements CompanyInterface
{
    protected $companyContract;
    public function __construct(CompanyContract $companyContract)
    {
        $this->companyContract = $companyContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->companyContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->companyContract->paginate($filters, $perPage);
    }

    public function find(int $id): Company
    {
        $company = $this->companyContract->find($id);
        if (! $company) {
            throw new ModelNotFoundException("Company #{$id} not found.");
        }
        return $company;
    }

    public function create(array $data): Company
    {
        if (empty($data['slug']) && ! empty($data['name'])) {
            $data['slug'] = SlugHelper::unique($data['name'], Company::class);
        }
        $company = $this->companyContract->create($data);
        return $company;
    }

    public function update(int $id, array $data): Company
    {
        $model = $this->find($id);
        if (empty($data['slug']) && ! empty($data['name'])) {
            $data['slug'] = SlugHelper::unique($data['name'], Company::class, $id);
        }
        $model = $this->companyContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->companyContract->delete($model);
    }
}
