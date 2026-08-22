<?php

use App\Http\Controllers\Skill\SkillController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('skills', SkillController::class);
});
