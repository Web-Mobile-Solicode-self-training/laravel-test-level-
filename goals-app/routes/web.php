<?php

use App\Http\Controllers\GoalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GoalController::class, 'index'])->name('public.index');
Route::get('/goals/{id}', [GoalController::class, 'show'])->name('public.show');