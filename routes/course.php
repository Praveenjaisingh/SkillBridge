<?php

use App\Http\Controllers\Course\CourseController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('courses', CourseController::class);
});
