<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class PaginationHelper
{
    public const DEFAULT_PER_PAGE = 15;

    public const MAX_PER_PAGE = 100;

    /**
     * Resolve a safe per-page value from the request.
     */
    public static function perPage(Request $request, int $default = self::DEFAULT_PER_PAGE): int
    {
        $perPage = (int) $request->integer('per_page', $default);

        if ($perPage <= 0) {
            return $default;
        }

        return min($perPage, self::MAX_PER_PAGE);
    }
}
