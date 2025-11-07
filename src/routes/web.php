<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InitialWeightController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WeightLogController;

Route::get('/register/step1', [RegisterController::class, 'showRegistrationForm'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'register']);

Route::get('/register/step2', [InitialWeightController::class, 'showForm'])->name('register.step2');
Route::post('/register/step2', [InitialWeightController::class, 'store']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::post('/weight_logs/{id}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{id}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
    Route::get('/target/edit', [App\Http\Controllers\WeightTargetController::class, 'edit'])->name('target.edit');
    Route::post('/target/update', [App\Http\Controllers\WeightTargetController::class, 'update'])->name('target.update');

});
