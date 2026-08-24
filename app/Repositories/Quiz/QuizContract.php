<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface QuizContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Quiz;
    public function create(array $data): Quiz;
    public function update(Quiz $quiz, array $data): Quiz;
    public function delete(Quiz $quiz): bool;
}
