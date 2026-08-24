<?php

namespace App\Repositories\Skill;

use App\Models\Skill;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SkillContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Skill;
    public function create(array $data): Skill;
    public function update(Skill $skill, array $data): Skill;
    public function delete(Skill $skill): bool;
}
