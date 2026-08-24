<?php

namespace App\Repositories\Bookmark;

use App\Models\Bookmark;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BookmarkContract
{
    public function all(array $filters = []): Collection;
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Bookmark;
    public function create(array $data): Bookmark;
    public function update(Bookmark $bookmark, array $data): Bookmark;
    public function delete(Bookmark $bookmark): bool;
}
