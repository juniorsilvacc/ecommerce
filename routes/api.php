<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Categorias
    Route::delete('/categories/{id}/delete', [CategoryController::class, 'destroy']);
    Route::put('/categories/{id}/update', [CategoryController::class, 'update']);
    Route::post('/categories/create', [CategoryController::class, 'store']);
    Route::get('/categories/{id}/details', [CategoryController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);

    // Products
    Route::delete('/products/{id}/delete', [ProductController::class, 'destroy']);
    Route::put('/products/{id}/update', [ProductController::class, 'update']);
    Route::post('/products/create', [ProductController::class, 'store']);
    Route::get('/products/{id}/details', [ProductController::class, 'show']);
    Route::get('/products', [ProductController::class, 'index']);
});
