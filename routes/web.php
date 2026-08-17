<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::post('/departments', [DepartmentController::class, 'store']);
// Route::get('/departments', [DepartmentController::class, 'index']);
// Route::get('/departments', [DepartmentController::class, 'create'])->name('department.create');

Route::resource('departments', DepartmentController::class);
