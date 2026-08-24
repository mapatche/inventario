<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('itemtypes', TypeController::class);
Route::resource('brands', BrandController::class);
Route::resource('items', ItemController::class);
