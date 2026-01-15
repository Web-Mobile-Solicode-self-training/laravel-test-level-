<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;


Route::get('/', function () {
    return redirect()->route('admin.goals.index');
});