<?php

declare(strict_types=1);

use App\Http\Controllers\HealthCheckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/health-check', HealthCheckController::class);

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group([
        'middleware' => 'api'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});
