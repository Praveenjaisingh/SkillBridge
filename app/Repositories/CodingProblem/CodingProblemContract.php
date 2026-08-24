<?php

namespace App\Repositories\CodingProblem;

use App\Models\CodingProblem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CodingProblemContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?CodingProblem;
    public function create(array $data): CodingProblem;
    public function update(CodingProblem $codingProblem, array $data): CodingProblem;
    public function delete(CodingProblem $codingProblem): bool;
}
