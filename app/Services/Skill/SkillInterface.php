<?php

namespace App\Services\Skill;

use App\Models\Skill;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SkillInterface
{
    public function list(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): Skill;
    public function create(array $data): Skill;
    public function update(int $id, array $data): Skill;
    public function delete(int $id): bool;
}
