<?php

use App\Http\Controllers\Quiz\QuizController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('quizzes', QuizController::class);
});
