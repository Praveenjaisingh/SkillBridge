<?php

use App\Http\Controllers\Resume\ResumeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('resumes', ResumeController::class);
});
