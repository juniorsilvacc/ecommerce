<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Categorias
    Route::get('/categories', [CategoryController::class, 'index']);
});
