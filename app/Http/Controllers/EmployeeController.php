<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveDepartmentRequest;
use App\Http\Requests\SaveEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use Laravel\Mcp\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('active', 1)->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(SaveEmployeeRequest $request)
    {
        $data = $request->validated();
        Employee::create($data);
        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('departments'), compact('employee'));
    }

    public function update(SaveEmployeeRequest $request, Employee $employee)
    {
        // dd($employee);
        $data = $request->validated();
        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'Empleado actualizado con éxito.');
    }

    public function destroy(Employee $employee)
    {
        $employee->update(['active' => 0]);
        return redirect()->route('employees.index')->with('status', 'Empleado desactivado con éxito.');
    }
}
