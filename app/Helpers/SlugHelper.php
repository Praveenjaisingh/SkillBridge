<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SlugHelper
{
    /**
     * Generate a unique slug for the given model/table based on a source string.
     */
    public static function unique(string $source, string $modelClass, ?int $ignoreId = null, string $column = 'slug'): string
    {
        $slug = Str::slug($source);
        $original = $slug;
        $counter = 1;

        $query = fn (string $candidate) => $modelClass::where($column, $candidate)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists();

        while ($query($slug)) {
            $slug = "{$original}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
