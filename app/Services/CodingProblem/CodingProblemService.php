<?php

namespace App\Services\CodingProblem;

use App\Helpers\SlugHelper;
use App\Models\CodingProblem;
use App\Repositories\CodingProblem\CodingProblemContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class CodingProblemService implements CodingProblemInterface
{
    public function __construct(
        protected CodingProblemContract $repository
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

    public function find(int $id): CodingProblem
    {
        $codingProblem = $this->repository->find($id);

        if (! $codingProblem) {
            throw new ModelNotFoundException("CodingProblem #{$id} not found.");
        }

        return $codingProblem;
    }

    public function create(array $data): CodingProblem
    {
        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], CodingProblem::class);
        }

        $codingProblem = $this->repository->create($data);

        return $codingProblem;
    }

    public function update(int $id, array $data): CodingProblem
    {
        $model = $this->find($id);

        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], CodingProblem::class, $id);
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
