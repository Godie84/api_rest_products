<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware(['auth:sanctum', 'can:create,App\Models\Product'])->post('/products', [ProductController::class, 'store']);
});


