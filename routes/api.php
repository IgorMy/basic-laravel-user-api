<?php

declare(strict_types=1);

use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// health check route
Route::get('/health-check', HealthCheckController::class);

// auth routes
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group([
        'middleware' => 'auth:jwt'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

// role routes
// Instead using resource, we are using explicit definition to prevent PUT/PATCH on update method
Route::prefix('role')->middleware(['admin','auth:jwt'])->group(function (){
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::get('/{RoleUlid}', [RoleController::class, 'show']);
        Route::patch('/{RoleUlid}', [RoleController::class, 'update']);
    }
);
