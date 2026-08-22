<?php

namespace App\Services\Bookmark;

use App\Models\Bookmark;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BookmarkInterface
{
    public function list(array $filters = []): Collection;

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Bookmark;

    public function create(array $data): Bookmark;

    public function update(int $id, array $data): Bookmark;

    public function delete(int $id): bool;
}
