<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('items', ItemController::class);
    Route::resource('loans', LoansController::class);
    Route::get('loans/items_by_type/{id}', [LoansController::class, 'itemsByType']);
    Route::get('loans/excelame/{id}', [LoansController::class, 'loanToSheet'])->name('excelsior');
});

Route::middleware(['auth', 'role:ADMIN'])->group(function () {
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('itemtypes', TypeController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
