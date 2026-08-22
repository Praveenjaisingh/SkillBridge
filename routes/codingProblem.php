<?php

use App\Http\Controllers\CodingProblem\CodingProblemController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('coding-problems', CodingProblemController::class);
});
