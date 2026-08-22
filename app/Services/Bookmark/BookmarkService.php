<?php

namespace App\Services\Bookmark;

use App\Models\Bookmark;
use App\Repositories\Bookmark\BookmarkContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class BookmarkService implements BookmarkInterface
{
    public function __construct(
        protected BookmarkContract $repository
    ) {
    }

    public function list(array $filters = []): Collection
    {
        return $this->repository->all($filters);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($filters, $perPage);
    }

    public function find(int $id): Bookmark
    {
        $bookmark = $this->repository->find($id);

        if (! $bookmark) {
            throw new ModelNotFoundException("Bookmark #{$id} not found.");
        }

        return $bookmark;
    }

    public function create(array $data): Bookmark
    {
        $bookmark = $this->repository->create($data);

        return $bookmark;
    }

    public function update(int $id, array $data): Bookmark
    {
        $model = $this->find($id);

        $model = $this->repository->update($model, $data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        return $this->repository->delete($model);
    }
}
