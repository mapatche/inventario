<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        $data = $request->validated();
        $data['uuid'] = (string) Str::uuid();
        Department::create($data);
        return response()->json(['message' => '¡Departamento creado con éxito!'], 201);
    }

    public function show(Department $department)
    {
        //
    }

    public function edit(Department $department)
    {
        //
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //
    }

    public function destroy(Department $department)
    {
        //
    }
}
