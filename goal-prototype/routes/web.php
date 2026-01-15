<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;

// Redirect root to admin for now (optional)
Route::get('/', function () {
    return redirect()->route('admin.goals.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Main Goal Management Routes
    Route::controller(GoalController::class)->group(function () {
        // GET /admin/goals (The main page & AJAX search)
        Route::get('/goals', 'index')->name('goals.index');
        
        // POST /admin/goals (Store the article/goal with image)
        Route::post('/goals', 'store')->name('goals.store');
        
        // DELETE /admin/goals/{id} (Remove an article)
        Route::delete('/goals/{goal}', 'destroy')->name('goals.destroy');
    });
    
});