<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HealthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Ruta pública: comprobar el estado de la API.
    Route::get('/health', HealthController::class)->name('health');

    // Ruta pública: iniciar sesión.
    Route::post('/auth/login', [AuthController::class, 'login'])
        ->middleware('throttle:login')
        ->name('auth.login');

    // Rutas protegidas: requieren un token válido de Sanctum.
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/auth/me', [AuthController::class, 'me'])
            ->name('auth.me');

        Route::post('/auth/logout', [AuthController::class, 'logout'])
            ->name('auth.logout');
    });
});