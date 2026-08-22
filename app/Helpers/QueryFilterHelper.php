<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class QueryFilterHelper
{
    /**
     * Apply a keyword search across the given columns.
     */
    public static function applySearch(Builder $query, ?string $keyword, array $columns): Builder
    {
        if (! $keyword || empty($columns)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($keyword, $columns) {
            foreach ($columns as $index => $column) {
                $method = $index === 0 ? 'where' : 'orWhere';
                $q->{$method}($column, 'like', "%{$keyword}%");
            }
        });
    }

    /**
     * Apply simple equality filters from an associative array, skipping empty values.
     */
    public static function applyFilters(Builder $query, array $filters, array $allowedColumns): Builder
    {
        foreach ($allowedColumns as $column) {
            if (array_key_exists($column, $filters) && $filters[$column] !== null && $filters[$column] !== '') {
                $query->where($column, $filters[$column]);
            }
        }

        return $query;
    }
}
