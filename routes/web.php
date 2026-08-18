<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::post('/departments', [DepartmentController::class, 'store']);
// Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
// Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
// Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
// Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');




Route::resource('departments', DepartmentController::class);

Route::get('prueba/{id}/edit', [App\Http\Controllers\DepartmentController::class, 'edit']);
