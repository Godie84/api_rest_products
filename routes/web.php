<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;


// Ruta de prueba
Route::get('api/test', function () {
    return response()->json(['message' => 'API works']);
});
