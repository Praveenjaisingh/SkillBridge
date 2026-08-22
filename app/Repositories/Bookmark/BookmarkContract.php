<?php

namespace App\Repositories\Bookmark;

use App\Models\Bookmark;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BookmarkContract
{
    /**
     * Get all Bookmark records matching the given filters.
     */
    public function all(array $filters = []): Collection;

    /**
     * Get a paginated list of Bookmark records matching the given filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a Bookmark by its primary key.
     */
    public function find(int $id): ?Bookmark;

    /**
     * Create a new Bookmark record.
     */
    public function create(array $data): Bookmark;

    /**
     * Update an existing Bookmark record.
     */
    public function update(Bookmark $bookmark, array $data): Bookmark;

    /**
     * Delete a Bookmark record.
     */
    public function delete(Bookmark $bookmark): bool;
}
