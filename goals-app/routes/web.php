<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\AdminController;
// Public
Route::get('/', [GoalController::class, 'index'])->name('index');
Route::get('/goal/{id}', [GoalController::class, 'show'])->name('show');

// Auth
Auth::routes();

// Admin AJAX
Route::middleware(['auth', 'permission:access-admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/save', [AdminController::class, 'save'])->name('admin.save');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});
