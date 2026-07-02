<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

Route::middleware('resolve.tenant')->group(function () {
    Route::get('/dashboard', function () {
        return 'Tenant Dashboard';
    });

    Route::get('register', AuthController::class . '@showRegisterForm')->name('register');
    Route::post('register', AuthController::class . '@register')->name('handle.register');
    Route::get('login', AuthController::class . '@showLoginForm')->name('login');
    Route::post('login', AuthController::class . '@login')->name('handle.login');
    Route::post('logout', AuthController::class . '@logout')->name('handle.logout');

    Route::get("home",HomeController::class."@home")->name("home");

    Route::get('tasks', TaskController::class . '@allTasks')->name('tasks');
    Route::get('tasks/create', TaskController::class . '@showCreateForm')->name('task.create');
    Route::post('tasks/create', TaskController::class . '@create')->name('handle.task.create');
});