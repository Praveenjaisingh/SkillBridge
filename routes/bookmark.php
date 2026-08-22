<?php

use App\Http\Controllers\Bookmark\BookmarkController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('bookmarks', BookmarkController::class);
});
