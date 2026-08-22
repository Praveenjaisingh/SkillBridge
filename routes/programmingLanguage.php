<?php

use App\Http\Controllers\ProgrammingLanguage\ProgrammingLanguageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('programming-languages', ProgrammingLanguageController::class);
});
