<?php

namespace App\Repositories\Bookmark;

use App\Helpers\QueryFilterHelper;
use App\Models\Bookmark;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BookmarkEloquent implements BookmarkContract
{
    public function all(array $filters = []): Collection
    {
        $query = Bookmark::query()->with(['user']);

        $query = QueryFilterHelper::applyFilters($query, $filters, ['user_id', 'bookmarkable_type']);

        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Bookmark::query()->with(['user']);

        $query = QueryFilterHelper::applyFilters($query, $filters, ['user_id', 'bookmarkable_type']);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?Bookmark
    {
        return Bookmark::query()->with(['user'])->find($id);
    }

    public function create(array $data): Bookmark
    {
        return Bookmark::create($data);
    }

    public function update(Bookmark $bookmark, array $data): Bookmark
    {
        $bookmark->update($data);

        return $bookmark->fresh(['user']);
    }

    public function delete(Bookmark $bookmark): bool
    {
        return (bool) $bookmark->delete();
    }
}
