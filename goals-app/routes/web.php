<?php

use App\Http\Controllers\GoalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [GoalController::class, 'index'])->name('public.index');

// Admin Routes 
Route::prefix('admin')->name('admin.goals.')->group(function () {
    Route::get('/goals', [AdminController::class, 'index'])->name('index');
    Route::post('/goals/store', [AdminController::class, 'store'])->name('store');
    Route::get('/goals/{id}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::delete('/goals/{id}', [AdminController::class, 'destroy'])->name('destroy');
});