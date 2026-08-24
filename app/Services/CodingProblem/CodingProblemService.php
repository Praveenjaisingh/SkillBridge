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
    protected $codingProblemContract;
    public function __construct(CodingProblemContract $codingProblemContract)
    {
        $this->codingProblemContract = $codingProblemContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->codingProblemContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->codingProblemContract->paginate($filters, $perPage);
    }

    public function find(int $id): CodingProblem
    {
        $codingProblem = $this->codingProblemContract->find($id);
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
        $codingProblem = $this->codingProblemContract->create($data);
        return $codingProblem;
    }

    public function update(int $id, array $data): CodingProblem
    {
        $model = $this->find($id);
        if (empty($data['slug']) && ! empty($data['title'])) {
            $data['slug'] = SlugHelper::unique($data['title'], CodingProblem::class, $id);
        }
        $model = $this->codingProblemContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->codingProblemContract->delete($model);
    }
}
