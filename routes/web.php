<?php

use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/skill.php';
require __DIR__.'/programmingLanguage.php';
require __DIR__.'/company.php';
require __DIR__.'/course.php';
require __DIR__.'/lesson.php';
require __DIR__.'/quiz.php';
require __DIR__.'/codingProblem.php';
require __DIR__.'/interviewQuestion.php';
require __DIR__.'/job.php';
require __DIR__.'/jobApplication.php';
require __DIR__.'/resume.php';
require __DIR__.'/bookmark.php';
