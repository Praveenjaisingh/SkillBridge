<?php

namespace App\Services\ProgrammingLanguage;

use App\Helpers\SlugHelper;
use App\Models\ProgrammingLanguage;
use App\Repositories\ProgrammingLanguage\ProgrammingLanguageContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class ProgrammingLanguageService implements ProgrammingLanguageInterface
{
    public function __construct(
        protected ProgrammingLanguageContract $repository
    ) {
    }

    public function list(array $filters = []): Collection
    {
        return $this->repository->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($filters, $perPage);
    }

    public function find(int $id): ProgrammingLanguage
    {
        $programmingLanguage = $this->repository->find($id);

        if (! $programmingLanguage) {
            throw new ModelNotFoundException("ProgrammingLanguage #{$id} not found.");
        }

        return $programmingLanguage;
    }

    public function create(array $data): ProgrammingLanguage
    {
        if (empty($data['slug']) && ! empty($data['name'])) {
            $data['slug'] = SlugHelper::unique($data['name'], ProgrammingLanguage::class);
        }

        $programmingLanguage = $this->repository->create($data);

        return $programmingLanguage;
    }

    public function update(int $id, array $data): ProgrammingLanguage
    {
        $model = $this->find($id);

        if (empty($data['slug']) && ! empty($data['name'])) {
            $data['slug'] = SlugHelper::unique($data['name'], ProgrammingLanguage::class, $id);
        }

        $model = $this->repository->update($model, $data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        return $this->repository->delete($model);
    }
}
