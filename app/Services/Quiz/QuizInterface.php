<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface QuizInterface
{
    public function list(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): Quiz;
    public function create(array $data): Quiz;
    public function update(int $id, array $data): Quiz;
    public function delete(int $id): bool;
}
