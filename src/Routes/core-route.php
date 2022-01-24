<?php

use Illuminate\Support\Facades\Route;
use Koraycicekciogullari\HydroCore\Controllers\DashboardController;

Route::middleware(['auth:sanctum', 'api'])->prefix('api/admin')->group(function(){
    Route::apiResource('dashboard', DashboardController::class)->only('index');
});
