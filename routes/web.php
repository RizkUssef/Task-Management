<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;

Route::middleware('resolve.tenant')->group(function () {
    Route::get('/', function () {
        $user = User::where('tenant_id', app('currentTenant')->id)->get();
        dd($user);
    });
    Route::get('/dashboard', function () {
        return 'Tenant Dashboard';
    });

    Route::get('register',AuthController::class.'@showRegisterForm');
    Route::post('register',AuthController::class.'@register')->name('handle.register');
});

// Route::domain('{tenant}.localhost')->group(function () {
    // Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/login',    [AuthController::class, 'login']);

    // Route::middleware(['auth:sanctum', 'resolve.tenant'])->group(function () {
    //     Route::post('/logout', [AuthController::class, 'logout']);
    //     Route::apiResource('tasks', TaskController::class);
    // });
// });