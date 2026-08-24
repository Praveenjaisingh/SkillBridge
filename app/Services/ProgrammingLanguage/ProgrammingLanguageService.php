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
    protected $programmingLanguageContract;
    public function __construct(ProgrammingLanguageContract $programmingLanguageContract) 
    {
        $this->programmingLanguageContract = $programmingLanguageContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->programmingLanguageContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->programmingLanguageContract->paginate($filters, $perPage);
    }

    public function find(int $id): ProgrammingLanguage
    {
        $programmingLanguage = $this->programmingLanguageContract->find($id);
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
        $programmingLanguage = $this->programmingLanguageContract->create($data);
        return $programmingLanguage;
    }

    public function update(int $id, array $data): ProgrammingLanguage
    {
        $model = $this->find($id);
        if (empty($data['slug']) && ! empty($data['name'])) {
            $data['slug'] = SlugHelper::unique($data['name'], ProgrammingLanguage::class, $id);
        }
        $model = $this->programmingLanguageContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->programmingLanguageContract->delete($model);
    }
}
