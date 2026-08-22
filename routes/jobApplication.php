<?php

use App\Http\Controllers\JobApplication\JobApplicationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('job-applications', JobApplicationController::class);
});
