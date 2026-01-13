<?php

use App\Http\Controllers\GoalController;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Admin\GoalController as AdminGoalController;

Route::get('/', [GoalController::class, 'index'])->name('public.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('goals', AdminGoalController::class);
});


