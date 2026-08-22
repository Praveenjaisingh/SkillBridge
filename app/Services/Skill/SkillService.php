<?php

namespace App\Services\Skill;

use App\Helpers\SlugHelper;
use App\Models\Skill;
use App\Repositories\Skill\SkillContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class SkillService implements SkillInterface
{
    public function __construct(
        protected SkillContract $repository
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

    public function find(int $id): Skill
    {
        $skill = $this->repository->find($id);

        if (! $skill) {
            throw new ModelNotFoundException("Skill #{$id} not found.");
        }

        return $skill;
    }

    public function create(array $data): Skill
    {
        if (empty($data['slug']) && ! empty($data['name'])) {
            $data['slug'] = SlugHelper::unique($data['name'], Skill::class);
        }

        $skill = $this->repository->create($data);

        return $skill;
    }

    public function update(int $id, array $data): Skill
    {
        $model = $this->find($id);

        if (empty($data['slug']) && ! empty($data['name'])) {
            $data['slug'] = SlugHelper::unique($data['name'], Skill::class, $id);
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
