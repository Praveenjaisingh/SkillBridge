<?php

use App\Http\Controllers\InterviewQuestion\InterviewQuestionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('interview-questions', InterviewQuestionController::class);
});
