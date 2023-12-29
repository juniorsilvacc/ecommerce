<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Categorias
    Route::put('/categories/{id}/update', [CategoryController::class, 'update']);
    Route::post('/categories/create', [CategoryController::class, 'store']);
    Route::get('/categories/{id}/details', [CategoryController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
});
