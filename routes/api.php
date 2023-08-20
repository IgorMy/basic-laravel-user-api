<?php

declare(strict_types=1);

use App\Http\Controllers\HealthCheckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/health-check', HealthCheckController::class);
