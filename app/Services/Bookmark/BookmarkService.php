<?php

namespace App\Services\Bookmark;

use App\Models\Bookmark;
use App\Repositories\Bookmark\BookmarkContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class BookmarkService implements BookmarkInterface
{
    protected $bookmarkContract;
    public function __construct(BookmarkContract $bookmarkContract)
    {
        $this->bookmarkContract = $bookmarkContract;
    }

    public function list(array $filters = []): Collection
    {
        return $this->bookmarkContract->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->bookmarkContract->paginate($filters, $perPage);
    }

    public function find(int $id): Bookmark
    {
        $bookmark = $this->bookmarkContract->find($id);
        if (! $bookmark) {
            throw new ModelNotFoundException("Bookmark #{$id} not found.");
        }
        return $bookmark;
    }

    public function create(array $data): Bookmark
    {
        $bookmark = $this->bookmarkContract->create($data);
        return $bookmark;
    }

    public function update(int $id, array $data): Bookmark
    {
        $model = $this->find($id);
        $model = $this->bookmarkContract->update($model, $data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $this->bookmarkContract->delete($model);
    }
}
