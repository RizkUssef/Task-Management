<?php

use Illuminate\Support\Facades\Route;

Route::middleware('resolve.tenant')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/dashboard', function () {
        return 'Tenant Dashboard';
    });
});

// Route::domain('{tenant}.localhost')->group(function () {
    // Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/login',    [AuthController::class, 'login']);

    // Route::middleware(['auth:sanctum', 'resolve.tenant'])->group(function () {
    //     Route::post('/logout', [AuthController::class, 'logout']);
    //     Route::apiResource('tasks', TaskController::class);
    // });
// });