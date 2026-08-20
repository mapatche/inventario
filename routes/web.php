<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Models\Department;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $departments = Department::all()->where('active', '=', 1);
    return view('departments.index', compact('departments'));
});

Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);
