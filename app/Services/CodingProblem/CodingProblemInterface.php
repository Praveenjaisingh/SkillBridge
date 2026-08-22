<?php

namespace App\Services\CodingProblem;

use App\Models\CodingProblem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CodingProblemInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): CodingProblem;

    public function create(array $data): CodingProblem;

    public function update(int $id, array $data): CodingProblem;

    public function delete(int $id): bool;
}
