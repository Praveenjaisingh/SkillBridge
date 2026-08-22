<?php

use App\Http\Controllers\Company\CompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('companies', CompanyController::class);
});
