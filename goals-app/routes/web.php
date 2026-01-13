<?php
use App\Http\Controllers\GoalController;
use App\Http\Controllers\AdminController;

// Public
Route::get('/', [GoalController::class, 'index'])->name('index');
Route::get('/goal/{id}', [GoalController::class, 'show'])->name('show');

// Admin AJAX
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/save', [AdminController::class, 'save'])->name('admin.save');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');