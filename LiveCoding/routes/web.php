<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;



Route::get('/', function () {
    return redirect()->route('admin.goals.index');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::post('/goals/store', [GoalController::class, 'store'])->name('goals.store');
});
