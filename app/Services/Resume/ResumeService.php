<?php

namespace App\Services\Resume;

use App\Models\Resume;
use App\Repositories\Resume\ResumeContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class ResumeService implements ResumeInterface
{
    protected $resumeContract;
    public function __construct(ResumeContract $resumeContract)
    {
       $this->resumeContract = $resumeContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->resumeContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->resumeContract->paginate($filters, $perPage);
    }

    public function find(int $id): Resume
    {
        $resume = $this->resumeContract->find($id);
        if (! $resume) {
            throw new ModelNotFoundException("Resume #{$id} not found.");
        }
        return $resume;
    }

    public function create(array $data): Resume
    {
        $resume = $this->resumeContract->create($data);
        return $resume;
    }

    public function update(int $id, array $data): Resume
    {
        $model = $this->find($id);
        $model = $this->resumeContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->resumeContract->delete($model);
    }
}
