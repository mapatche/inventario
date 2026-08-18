<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\SaveDepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all()->where('active', '=', 1);
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(SaveDepartmentRequest $request)
    {
        $data = $request->validated();
        Department::create($data);
        return redirect()->route('departments.index');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(SaveDepartmentRequest $request, Department $department)
    {
        $data = $request->validated();
        $department->update($data);
        return redirect()->route('departments.index');
    }

    public function destroy(Department $department)
    {
        $department->active = false;
        $department->save();
        return redirect()->route('departments.index');
    }
}
