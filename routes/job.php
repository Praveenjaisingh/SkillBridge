<?php

use App\Http\Controllers\Job\JobController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('jobs', JobController::class);
});
