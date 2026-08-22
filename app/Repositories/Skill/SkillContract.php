<?php

namespace App\Repositories\Skill;

use App\Models\Skill;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SkillContract
{
    /**
     * Get all Skill records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of Skill records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a Skill by its primary key.
     */
    public function find(int $id): ?Skill;

    /**
     * Create a new Skill record.
     */
    public function create(array $data): Skill;

    /**
     * Update an existing Skill record.
     */
    public function update(Skill $skill, array $data): Skill;

    /**
     * Delete a Skill record.
     */
    public function delete(Skill $skill): bool;
}
